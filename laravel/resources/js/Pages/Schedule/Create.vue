<script setup>
import { ref } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

const page = usePage();
const psicologa_id = page.props.value.psicologa_id;

console.log('Psicologa ID:', psicologa_id);

const form = useForm({
    psicologa_id: psicologa_id,
    dia: '',
    hora_inicio: '',
    hora_fim: '',
    ocupado: false,
});

const submit = () => {
    form.post(route('agendas.store'));
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Criar Agenda" />
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Criar Agenda</h2>
                        <form @submit.prevent="submit">
                            <div class="mt-4">
                                <label for="dia" class="block text-sm font-medium text-gray-700">Dia</label>
                                <input id="dia" v-model="form.dia" type="date" class="mt-1 block w-full">
                                <span v-if="form.errors.dia" class="text-red-600 text-sm">{{ form.errors.dia }}</span>
                            </div>

                            <div class="mt-4">
                                <label for="hora_inicio" class="block text-sm font-medium text-gray-700">Hora de Início</label>
                                <input id="hora_inicio" v-model="form.hora_inicio" type="time" class="mt-1 block w-full">
                                <span v-if="form.errors.hora_inicio" class="text-red-600 text-sm">{{ form.errors.hora_inicio }}</span>
                            </div>

                            <div class="mt-4">
                                <label for="hora_fim" class="block text-sm font-medium text-gray-700">Hora de Fim</label>
                                <input id="hora_fim" v-model="form.hora_fim" type="time" class="mt-1 block w-full">
                                <span v-if="form.errors.hora_fim" class="text-red-600 text-sm">{{ form.errors.hora_fim }}</span>
                            </div>

                            <div class="mt-4">
                                <label for="ocupado" class="block text-sm font-medium text-gray-700">Ocupado</label>
                                <input id="ocupado" v-model="form.ocupado" type="checkbox" class="mt-1">
                                <span v-if="form.errors.ocupado" class="text-red-600 text-sm">{{ form.errors.ocupado }}</span>
                            </div>

                            <div class="mt-6">
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">
                                    Criar Agenda
                                </button>
                                <Link
                                    :href="route('agendas.index')"
                                    class="ml-4 text-blue-600"
                                >
                                    Voltar
                                </Link>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
