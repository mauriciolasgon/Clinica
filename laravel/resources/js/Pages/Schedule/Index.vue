<script setup>
import { ref, watch } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';
import axios from 'axios'; // Certifique-se de importar axios
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const { props } = usePage();
const psicologas = ref(props.psicologas);
const selectedPsicologa = ref(null);
const psychologistSchedule = ref([]);

const dadosForm = useForm({
  paciente_id: '',
  ocupado: '',
});

const fetchPsychologistSchedule = async () => {
  try {
    const response = await axios.get('/schedule/schedule', {
      params: { psicologa_id: selectedPsicologa.value }
    });
    psychologistSchedule.value = response.data;
    console.log(psychologistSchedule.value);
  } catch (error) {
    console.error('Error fetching psychologist schedule:', error);
  }
};

const submitForm = (schedule) => {
  dadosForm.paciente_id = props.auth.user.id;
  dadosForm.ocupado = true;

  dadosForm.post(route('schedule.update', { schedule_id: schedule.id }), {
    onSuccess: () => {
      alert('Agendamento atualizado com sucesso.');
    },
    onError: (errors) => {
      console.error('Erro ao atualizar o agendamento:', errors);
    }
  });
};

// Watcher para chamar fetchPsychologistSchedule sempre que selectedPsicologa mudar
watch(selectedPsicologa, (newVal, oldVal) => {
  if (newVal !== null) {
    fetchPsychologistSchedule();
  }
});

const voltar = () => {
  window.history.back();
};
</script>

<template>
  <AuthenticatedLayout>
    <Head title="Marcar consulta" />

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 dark:text-gray-100">
            <button @click="voltar" class="back-button">Voltar</button>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Selecione sua psicóloga</h2>
            <div>
              <label for="psicologa">Selecione uma Psicóloga:</label>
              <select v-model="selectedPsicologa" id="psicologa">
                <option v-for="psicologa in psicologas" :key="psicologa.id" :value="psicologa.id">
                  {{ psicologa.name }}
                </option>
              </select>
            </div>
            <div v-if="selectedPsicologa !== null">
              <!-- Exibir o horário da psicóloga selecionada -->
              <h3>Horário da Psicóloga:</h3>
              <ul>
                <li v-for="schedule in psychologistSchedule" :key="schedule.id">
                  <div v-if="schedule.ocupado !== 1">
                    {{ schedule.data }}
                    {{ schedule.horario }}
                    {{ schedule.tempo_sessao }}
                    <form @submit.prevent="submitForm(schedule)">
                      <button type="submit" class="mt-6 inline-block px-4 py-2 bg-blue-600 text-white rounded-md">
                        Marcar consulta
                      </button>
                    </form>
                  </div>
                </li>
              </ul>
            </div>
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
