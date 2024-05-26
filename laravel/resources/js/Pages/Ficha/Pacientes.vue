<script setup>
import { ref, onMounted } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, usePage } from '@inertiajs/vue3';
import ConfirmPassword from '../Auth/ConfirmPassword.vue';


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


</script>

<template>
    <div>
      <h1>Pacientes</h1>
        <ul>
        
          <li v-for="agendamento in psychologistSchedule" :key="agendamento.id">
            <span>{{ agendamento.paciente.name }}</span> 
            <Link :href="route('ficha' ,{ data: agendamento })"
              class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white"
              > Ficha</Link>      
          </li>
        </ul>
      
    </div>
  </template>
  
