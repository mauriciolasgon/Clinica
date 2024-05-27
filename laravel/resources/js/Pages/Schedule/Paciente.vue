<script setup>
import { ref, computed } from 'vue';
import { Link, usePage } from '@inertiajs/vue3';

const { props } = usePage();
const agendamentos = ref(props.agendamentos);
const mostrarTodos = ref(false);

// Ordenar os agendamentos por data crescente
const agendamentosOrdenados = computed(() => {
    if (mostrarTodos.value) {
        return agendamentos.value.sort((a, b) => new Date(a.data) - new Date(b.data));
    } else {
        const dataAtual = new Date();
        return agendamentos.value.filter(agendamento => new Date(agendamento.data) > dataAtual)
            .sort((a, b) => new Date(a.data) - new Date(b.data));
    }
});

const alternarMostrarTodos = () => {
    mostrarTodos.value = !mostrarTodos.value;
};
</script>

<template>
  <div>
    <h1>Agendamentos</h1>
    <button @click="alternarMostrarTodos">{{ mostrarTodos.value ? 'Exibir Futuros' : 'Mostrar Todos' }}</button>
    <ul>
      <li v-for="agendamento in agendamentosOrdenados" :key="agendamento.id">
          <div>
            <span>{{ agendamento.paciente.name }}</span>
            <span>Data da sessão: {{ agendamento.data }}</span>
            <span>Horário da sessão: {{ agendamento.horario }}</span>
            <span>Duração da sessão: {{ agendamento.tempo_sessao }}</span>
            <Link :href="route('ficha', { data: agendamento })" class="view-ficha-link">Acessar Ficha</Link>
          </div>
      </li>
    </ul>
  </div>
</template>
