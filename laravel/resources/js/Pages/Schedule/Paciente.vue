<template>
  <div class="paciente-container">
    <h1 class="paciente-title">Agendamentos</h1>

    <div class="buttons-container">
      <button @click="exibirFuturos" class="toggle-button">
        Futuros
      </button>
      <button @click="exibirHistorico" class="toggle-button">
        Histórico
      </button>
      <button @click="alternarMostrarTodos" class="toggle-button">
        Mostrar Todos
      </button>
    </div>

    <div v-if="mostrarFuturos || mostrarTodos">
      <h2 class="section-title">Atendimentos Futuros</h2>
      <ul class="agendamentos-list">
        <li v-for="agendamento in agendamentosFuturos" :key="agendamento.id" class="agendamento-item">
          <div>
            <span class="paciente-name">{{ agendamento.paciente.name }}</span>
            <span class="agendamento-details">Data: {{ agendamento.data }}</span>
            <span class="agendamento-details">Horário: {{ agendamento.horario }}</span>
            <span class="agendamento-details">Duração: {{ agendamento.tempo_sessao }}</span>
            <button class="view-ficha-button" @click="acessarFicha(agendamento)">
              Acessar Ficha
            </button>
          </div>
        </li>
      </ul>
    </div>

    <div v-if="mostrarHistorico || mostrarTodos">
      <h2 class="section-title">Histórico de Atendimentos</h2>
      <ul class="agendamentos-list">
        <li v-for="agendamento in agendamentosPassados" :key="agendamento.id" class="agendamento-item">
          <div>
            <span class="paciente-name">{{ agendamento.paciente.name }}</span>
            <span class="agendamento-details">Data: {{ agendamento.data }}</span>
            <span class="agendamento-details">Horário: {{ agendamento.horario }}</span>
            <span class="agendamento-details">Duração: {{ agendamento.tempo_sessao }}</span>
            <button class="view-ficha-button" @click="acessarFicha(agendamento)">
              Acessar Ficha
            </button>
          </div>
        </li>
      </ul>
    </div>
  </div>
</template>
<script setup>
import { ref, computed } from 'vue';
import { usePage } from '@inertiajs/vue3';

const { props } = usePage();
const agendamentos = ref(props.agendamentos);
const mostrarTodos = ref(false);
const mostrarFuturos = ref(true);
const mostrarHistorico = ref(false);

const agendamentosFuturos = computed(() => {
  const dataAtual = new Date();
  return agendamentos.value.filter(agendamento => new Date(agendamento.data) > dataAtual)
    .sort((a, b) => new Date(a.data) - new Date(b.data));
});

const agendamentosPassados = computed(() => {
  const dataAtual = new Date();
  return agendamentos.value.filter(agendamento => new Date(agendamento.data) <= dataAtual)
    .sort((a, b) => new Date(b.data) - new Date(a.data));
});

const alternarMostrarTodos = () => {
  mostrarTodos.value = !mostrarTodos.value;
  mostrarFuturos.value = false;
  mostrarHistorico.value = false;
};

const exibirFuturos = () => {
  mostrarFuturos.value = true;
  mostrarHistorico.value = false;
  mostrarTodos.value = false;
};

const exibirHistorico = () => {
  mostrarFuturos.value = false;
  mostrarHistorico.value = true;
  mostrarTodos.value = false;
};

const acessarFicha = (agendamento) => {
  window.location.href = route('ficha', { data: agendamento });
};
</script>
<style scoped>
.paciente-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 30px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

.paciente-title {
    font-size: 36px;
    margin-bottom: 20px;
    color: #333333;
    text-align: center;
}

.buttons-container {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}

.toggle-button {
    background-color: #4a90e2;
    color: #ffffff;
    border: none;
    border-radius: 25px;
    padding: 12px 25px;
    margin: 0 10px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
}

.toggle-button:hover {
    opacity: 0.8;
}

.section-title {
    font-size: 24px;
    margin: 20px 0 10px;
    color: #333333;
    text-align: left;
}

.agendamentos-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.agendamento-item {
    margin-bottom: 15px;
    padding: 15px;
    background-color: #f9f9f9;
    border-radius: 8px;
}

.paciente-name {
    font-weight: bold;
    color: #333333;
}

.agendamento-details {
    display: block;
    margin-top: 5px;
    color: #666666;
}

.view-ficha-button {
    margin-top: 10px;
    background-color: #4a90e2;
    color: #ffffff;
    border: none;
    border-radius: 25px;
    padding: 10px 20px;
    cursor: pointer;
    transition: background-color 0.3s, color 0.3s;
}

.view-ficha-button:hover {
    opacity: 0.8;
}
</style>
