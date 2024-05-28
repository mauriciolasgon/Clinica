<template>
  <div class="paciente-container">
    <h1 class="paciente-title">Agendamentos</h1>

    <!-- Botão de voltar -->
    <button @click="voltarPagina" class="btn btn-back">Voltar</button>

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

function voltarPagina() {
    window.history.back();
}
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
    font-size: 28px;
    margin-bottom: 20px;
    color: #555555;
    text-align: center;
}

.agendamentos-list {
    list-style-type: none;
    padding: 0;
}

.agendamento-item {
    background-color: #f0f0f0;
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
}

.paciente-name {
    font-size: 20px;
    font-weight: bold;
    margin-bottom: 10px;
}

.agendamento-details {
    font-size: 16px;
    margin-bottom: 5px;
}

.view-ficha-button {
    background-color: #48bb78;
    color: #ffffff;
    border: none;
    border-radius: 25px;
    padding: 10px 20px;
    cursor: pointer;
    align-self: flex-start;
    transition: background-color 0.3s, color 0.3s;
}

.view-ficha-button:hover {
    opacity: 0.8;
}

.btn-back {
    background-color: #555;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    margin-bottom: 20px;
    transition: background-color 0.3s, color 0.3s;
}

.btn-back:hover {
    opacity: 0.8;
}
</style>
