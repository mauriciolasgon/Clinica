<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard do Psicólogo</h2>
    </template>

    <div class="container mx-auto p-4">
      <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold">Adicionar Sessão</h1>
        <button @click="goBack" class="text-blue-600 hover:underline">Voltar</button>
      </div>

      <form @submit.prevent="submitAgendaForm" class="max-w-lg mx-auto">
        <div class="mb-4">
          <label for="data" class="block text-sm font-medium text-gray-700">Data</label>
          <input id="data" v-model="form.data" type="date" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div class="mb-4">
          <label for="horario" class="block text-sm font-medium text-gray-700">Hora</label>
          <input id="horario" v-model="form.horario" type="time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div class="mb-4">
          <label for="tempo_sessao" class="block text-sm font-medium text-gray-700">Duração (HH:mm)</label>
          <input id="tempo_sessao" v-model="form.tempo_sessao" type="time" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div class="mt-6">
          <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Adicionar Sessão</button>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>

<script>
import { ref } from 'vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Link, usePage } from '@inertiajs/vue3';

export default {
    data() {
        return {
            form: {
                psicologa_id: '',
                agenda_id: '',
                data: '',
                horario: '',
                tempo_sessao: '', 
                ocupado: 1,
            },
        };
    },
    methods: {
        submitAgendaForm() {
            this.form.psicologa_id = usePage().props.auth.user.id;
            if (this.form.tempo_sessao.length === 5) {
                this.form.tempo_sessao += ':00';
            }
            console.log('Dados do formulário antes do envio:', this.form);
            this.$inertia.post(route('agendas.store'), this.form, {
                onSuccess: () => {
                    alert('Sessão adicionada com sucesso!');
                    this.$router.push('/agendas/index');
                },
                onError: (errors) => {
                    console.error(errors);
                }
            });
        },
        goBack() {
            window.history.back();
        }
    },
};
</script>
