<script setup>
import { ref } from 'vue';
import { usePage, useForm, Link } from '@inertiajs/vue3';

const { props } = usePage();
const consultas = ref(props.consultas);




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
    <div class="max-w-4xl mx-auto py-8 px-4">
        <Link :href="route('dashboard')" class="btn btn-secondary mb-4 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">
            Voltar
        </Link>

        <h1 class="text-3xl font-bold mb-6">Consultas</h1>
        <ul class="space-y-4">
            <li v-for="consulta in consultas" :key="consulta.id" class="bg-white p-4 rounded-lg shadow-md">
                <div v-if="consulta.paciente !== null ">
                    <div class="flex justify-between">
                        <span class="font-semibold">{{ consulta.data }}</span>
                        <span>{{ consulta.horario }}</span>
                    </div>
                    <div class="mt-2">
                        <span class="text-gray-700">Paciente: {{ consulta.paciente.name }}</span>
                    </div>
                    <div class="mt-1">
                        <span class="text-gray-700">Psicóloga: {{ consulta.psicologa.name }}</span>
                    </div>
                    <button @click="acionarChegada(consulta)" class="mt-4 bg-green-500 text-white py-2 px-4 rounded hover:bg-green-700" 
                    v-if="consulta.chegada === 0"
                    >
                        Acionar chegada
                    </button>
                    <span v-if="consulta.chegada !== 0">Psicologa ja notificada</span>
                </div>
            </li>
        </ul>
    </div>
</template>
