<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const schedules = ref([]);

const fetchSchedules = async () => {
    try {
        const response = await axios.get('/schedule'); 
        schedules.value = response.data;
    } catch (error) {
        console.error('Error fetching schedules:', error);
    }
};

onMounted(() => {
    fetchSchedules();
});
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Schedule" />

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Schedule</h2>
                        <ul>
                            <li v-for="schedule in schedules" :key="schedule.id" class="mt-4">
                                <span>{{ schedule.data }} - {{ schedule.tempo_de_sessao }} mins - {{ schedule.ocupado ? 'Ocupado' : 'Disponível' }}</span>
                                <Link :href="route('schedule.edit', schedule.id)" class="ml-4 text-blue-600">Editar</Link>
                            </li>
                        </ul>
                        <Link
                            :href="route('schedule.create')"
                            class="mt-6 inline-block px-4 py-2 bg-blue-600 text-white rounded-md"
                        >
                            Criar Sessão
                        </Link>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
