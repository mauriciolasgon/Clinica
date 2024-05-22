<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    data: '',
    hora: '',
    tempo_de_sessao: '',
});

const submit = () => {
    form.post(route('agendas.store'), {
        onSuccess: () => form.reset(),
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Criar Agendamento" />

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Criar Agendamento</h2>

                        <form @submit.prevent="submit">
                            <div>
                                <label for="data" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Data</label>
                                <input
                                    id="data"
                                    type="date"
                                    v-model="form.data"
                                    class="mt-1 block w-full"
                                    required
                                />
                                <div v-if="form.errors.data" class="text-red-600 text-sm mt-1">{{ form.errors.data }}</div>
                            </div>

                            <div class="mt-4">
                                <label for="hora" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Horário</label>
                                <input
                                    id="hora"
                                    type="time"
                                    v-model="form.hora"
                                    class="mt-1 block w-full"
                                    required
                                />
                                <div v-if="form.errors.hora" class="text-red-600 text-sm mt-1">{{ form.errors.hora }}</div>
                            </div>

                            <div class="mt-4">
                                <label for="tempo_de_sessao" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Duração (minutos)</label>
                                <input
                                    id="tempo_de_sessao"
                                    type="number"
                                    v-model="form.tempo_de_sessao"
                                    class="mt-1 block w-full"
                                    required
                                />
                                <div v-if="form.errors.tempo_de_sessao" class="text-red-600 text-sm mt-1">{{ form.errors.tempo_de_sessao }}</div>
                            </div>

                            <div class="flex items-center justify-end mt-4">
                                <Link
                                    :href="route('agendas.index')"
                                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                >
                                    Voltar
                                </Link>

                                <button
                                    type="submit"
                                    class="ml-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150"
                                    :disabled="form.processing"
                                >
                                    Salvar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
