<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm, usePage } from '@inertiajs/vue3';

const pageProps = usePage().props.value || {};
const agenda = pageProps.agenda || {};
const form = useForm({
    dia: agenda.dia || '',
    hora_inicio: agenda.hora_inicio || '',
    hora_fim: agenda.hora_fim || '',
    ocupado: agenda.ocupado || false,
});

const submit = () => {
    form.put(route('agendas.update', agenda.id), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Editar Agenda" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="dia" value="Dia" />
                <TextInput
                    id="dia"
                    type="date"
                    class="mt-1 block w-full"
                    v-model="form.dia"
                    required
                />
                <InputError class="mt-2" :message="form.errors.dia" />
            </div>

            <div class="mt-4">
                <InputLabel for="hora_inicio" value="Hora Início" />
                <TextInput
                    id="hora_inicio"
                    type="time"
                    class="mt-1 block w-full"
                    v-model="form.hora_inicio"
                    required
                />
                <InputError class="mt-2" :message="form.errors.hora_inicio" />
            </div>

            <div class="mt-4">
                <InputLabel for="hora_fim" value="Hora Fim" />
                <TextInput
                    id="hora_fim"
                    type="time"
                    class="mt-1 block w-full"
                    v-model="form.hora_fim"
                    required
                />
                <InputError class="mt-2" :message="form.errors.hora_fim" />
            </div>

            <div class="mt-4">
                <InputLabel for="ocupado" value="Ocupado" />
                <input
                    id="ocupado"
                    type="checkbox"
                    v-model="form.ocupado"
                />
                <InputError class="mt-2" :message="form.errors.ocupado" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Atualizar Agenda
                </PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
