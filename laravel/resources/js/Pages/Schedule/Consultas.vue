<script setup>
import { ref} from 'vue';
import {usePage,useForm } from '@inertiajs/vue3';

const { props } = usePage();
const consultas = ref(props.consultas);
console.log(consultas);



const chegou = useForm({
    chegada: '',
});


const acionarChegada = (consulta) => {
  chegou.chegada = 1;
  chegou.post(route('schedule.update', { schedule_id: consulta.id }), {
        onSuccess: () => {
            alert('Notificação enviada com sucesso');
        },
        onError: (errors) => {
            console.error('Erro ao notificar', errors);
        }
    });
};

</script>

<template>
  <div>
    <h1>Consultas</h1>
    <ul>
      <li v-for="consulta in consultas" :key="consulta.id">
          <div v-if="consulta.paciente !== null">
            <span>{{ consulta.data }}</span>
            <span>{{ consulta.paciente.name }}</span>
            <span>{{ consulta.horario }}</span>
            <span>{{ consulta.psicologa.name }}</span>
            <button @click="acionarChegada(consulta)">Acionar chegada</button>
          </div>
      </li>
    </ul>
  </div>
</template>
