<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    numero_cel: '',
    cep: '',
    address: '',
    city: '',
    state: '',
    role: 1,
});

const submit = () => {
    form.post(route('register'), {
        onFinish: () => form.reset('password', 'password_confirmation'),
    });
};

const fetchAddress = async () => {
    if (form.cep.length === 8) {
        try {
            const response = await fetch(`https://viacep.com.br/ws/${form.cep}/json/`);
            const data = await response.json();
            if (!data.erro) {
                form.address = data.logradouro;
                form.city = data.localidade;
                form.state = data.uf;
            } else {
                console.log('CEP não encontrado');
            }
        } catch (error) {
            console.error('Erro ao buscar endereço:', error);
        }
    }
};

const formatPhoneNumber = (value) => {
    const cleaned = value.replace(/\D/g, '');
    const match = cleaned.match(/^(\d{2})(\d{5})(\d{4})$/);
    if (match) {
        return `(${match[1]}) ${match[2]}-${match[3]}`;
    }
    return value;
};
</script>

<template>
    <GuestLayout>
        <Head title="Register" />

        <Link :href="route('dashboard')" class="btn btn-secondary mb-4 bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-700">
            Voltar
        </Link>

        <form @submit.prevent="submit" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-6">Registro</h2>

            <div>
                <InputLabel for="name" value="Nome" />
                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    required
                    autofocus
                    autocomplete="name"
                />
                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />
                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />
                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="numero_cel" value="Celular" />
                <TextInput
                    id="numero_cel"
                    type="tel"
                    class="mt-1 block w-full"
                    v-model="form.numero_cel"
                    required
                    autocomplete="phone_number"
                    @input="form.numero_cel = formatPhoneNumber(form.numero_cel)"
                />
                <InputError class="mt-2" :message="form.errors.numero_cel" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Senha" />
                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirmar Senha" />
                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                />
                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>

            <div class="mt-4">
                <InputLabel for="cep" value="CEP" />
                <TextInput
                    id="cep"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.cep"
                    @input="fetchAddress"
                    maxlength="8"
                    autocomplete="postal-code"
                />
                <InputError class="mt-2" :message="form.errors.cep" />
            </div>

            <div class="mt-4">
                <InputLabel for="address" value="Endereço" />
                <TextInput
                    id="address"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.address"
                    required
                />
                <InputError class="mt-2" :message="form.errors.address" />
            </div>

            <div class="mt-4">
                <InputLabel for="city" value="Cidade" />
                <TextInput
                    id="city"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.city"
                    required
                />
                <InputError class="mt-2" :message="form.errors.city" />
            </div>

            <div class="mt-4">
                <InputLabel for="state" value="Estado" />
                <TextInput
                    id="state"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.state"
                    required
                    maxlength="2"
                />
                <InputError class="mt-2" :message="form.errors.state" />
            </div>

            <div class="flex items-center justify-end mt-6">
                <Link
                    :href="route('login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Já registrado?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Registrar
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
