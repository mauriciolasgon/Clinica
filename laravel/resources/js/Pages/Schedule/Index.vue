<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { usePage } from '@inertiajs/vue3';

const { props } = usePage();
const psicologas = ref(props.psicologas);

onMounted(() => {
    console.log('Psicologas:', psicologas.value);
});
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Marcar consulta" />

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Selecione sua psicóloga</h2>
                        <ul>
                            <li v-for="psicologa in psicologas" :key="psicologa.id" class="mt-4">
                                <span>{{ psicologa.name }}</span>
                                <Link :href="route('schedule.edit', { schedule: psicologa.id })" class="ml-4 text-blue-600">Editar</Link>
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
