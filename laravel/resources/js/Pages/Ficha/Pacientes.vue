<script setup>
import { ref, onMounted } from 'vue';

import { Link, usePage } from '@inertiajs/vue3';



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


</script>

<template>
  <div  class="container">
    <h1 class="page-title">Pacientes</h1>
    <ul class="patient-list">
      <li v-for="agendamento in psychologistSchedule" :key="agendamento.id" class="patient-item">
        <div class="patient-info">
          <span class="patient-name">{{ agendamento.paciente.name }}</span> 
          <Link :href="route('ficha', { data: agendamento })" class="view-ficha-link">Ver Ficha</Link>
        </div>
      </li>
    </ul>
  </div>
</template>

<style scoped>
.container {
  max-width: 800px; /* Define a largura máxima do container */
  margin: 0 auto; /* Centraliza o container horizontalmente */
  padding: 0 20px; /* Adiciona um espaço nas laterais */
}

.page-title {
  font-size: 28px;
  color: #333;
  margin-bottom: 20px;
  border-bottom: 1px solid #007bff;
  padding-bottom: 5px;
}
.patient-list {
  list-style: none;
  padding: 0;
}

.patient-item {
  margin-bottom: 15px;
}

.patient-info {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

.patient-name {
  font-weight: bold;
}

.view-ficha-link {
  padding: 5px 10px;
  background-color: #007bff;
  color: #fff;
  border: none;
  border-radius: 5px;
  text-decoration: none;
  transition: background-color 0.3s ease;
}

.view-ficha-link:hover {
  background-color: #0056b3;
}
</style>
  
