<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    dia: '',
    hora_inicio: '',
    hora_fim: '',
});

const submit = () => {
    form.post(route('agendas.store'), {
        onFinish: () => form.reset(),
    });
};
</script>

<template>
    <AuthenticatedLayout>
        <Head title="Criar Agenda" />

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

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Criar Agenda
                </PrimaryButton>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
