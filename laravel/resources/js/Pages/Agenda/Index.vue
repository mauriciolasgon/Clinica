<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';

const { props } = usePage();
const agendas = ref([]);
const psico_id = usePage().props.auth.user.id;
const psychologistSchedule = ref([]);

const fetchPsychologistSchedule = async () => {
  try {
    const response = await axios.get('/schedule/schedule', {
      params: { psicologa_id: psico_id }
    });
    psychologistSchedule.value = response.data;
  } catch (error) {
    console.error('Error fetching psychologist schedule:', error);
  }
};

onMounted(() => {
  fetchPsychologistSchedule();
});

const voltar = () => {
  window.history.back();
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Schedule" />
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 dark:text-gray-100">
            <button @click="voltar" class="back-button">Voltar</button>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Agenda</h2>
            <ul>
              <li v-for="schedule in psychologistSchedule" :key="schedule.id">
                <span>
                  <span v-if="schedule.paciente">{{ schedule.paciente.name }}</span>
                  - {{ schedule.data }} - {{ schedule.horario }} - horario - {{ schedule.tempo_sessao }} mins - {{ schedule.ocupado ? 'Ocupado' : 'Disponível' }}
                </span>
                <Link :href="route('schedule.edit', schedule.id)" class="ml-4 text-blue-600">Editar</Link>
              </li>
            </ul>
            <Link :href="route('agendas.create')" class="mt-6 inline-block px-4 py-2 bg-blue-600 text-white rounded-md">
              Criar Agenda
            </Link>
          </div>
          <div class="p-6 text-gray-900 dark:text-gray-100 mt-8">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Agenda Completa da Psicóloga</h2>
            <ul>
              <li v-for="entry in psychologistSchedule" :key="entry.id" class="mt-4">
                <span>{{ entry.data }} - {{ entry.horario }} - {{ entry.tempo_sessao }} mins - {{ entry.ocupado ? 'Ocupado' : 'Disponível' }}</span>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.back-button {
  background-color: #4a90e2;
  color: #ffffff;
  border: none;
  border-radius: 25px;
  padding: 12px 25px;
  margin-bottom: 20px;
  cursor: pointer;
  transition: background-color 0.3s, color 0.3s;
}

.back-button:hover {
  opacity: 0.8;
}
</style>
