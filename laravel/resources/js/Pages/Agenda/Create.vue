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
    },
};


</script>

<template>
  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard do Psicólogo</h2>
    </template>
    <a :href="route('agendas.index')" class="btn-back">Voltar</a>
    <div class="container mx-auto p-4">
      <h1 class="text-3xl font-bold mb-4">Adicionar Sessão</h1>

      <form @submit.prevent="submitAgendaForm">
        <div class="mb-4">
          <label for="data" class="block text-gray-700">Data</label>
          <input id="data" v-model="form.data" type="date" class="mt-1 block w-full" required>
        </div>
        <div class="mb-4">
          <label for="horario" class="block text-gray-700">Hora</label>
          <input id="horario" v-model="form.horario" type="time" class="mt-1 block w-full" required>
        </div>
        <div class="mb-4">
          <label for="tempo_sessao" class="block text-gray-700">Duração (HH:mm)</label>
          <input id="tempo_sessao" v-model="form.tempo_sessao" type="time" class="mt-1 block w-full" required>
        </div>
        <div class="mt-4">
          <button type="submit" class="px-4 py-2 bg-blue-500 text-white">Adicionar Sessão</button>
        </div>
      </form>
    </div>
  </AuthenticatedLayout>
</template>

<style scoped>
.btn-back {
    display: inline-block;
    margin-bottom: 20px;
    padding: 10px 20px;
    background-color: #007bff;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    font-size: 16px;
    text-align: center;
}

.btn-back:hover {
    background-color: #0056b3;
}
</style>

