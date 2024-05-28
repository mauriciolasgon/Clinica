<<<<<<< Updated upstream
<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>
=======
<template>
    <div class="dashboard-container">
        <h1 class="dashboard-title">Dashboard</h1>

        <!-- Botão de voltar -->
        <button @click="voltarPagina" class="btn btn-back">Voltar</button>

        <AuthenticatedLayout>
            <template #header>
                <h2 class="dashboard-subtitle">Bem-vindo</h2>
            </template>

            <div class="dashboard-actions">
                <div v-if="$page.props.auth.user.role == 3" class="action-group">
                    <Link :href="route('register')" class="btn btn-primary">
                        Registrar
                    </Link>
                    <Link :href="route('register.psicologa')" class="btn btn-primary">
                        Registrar Psicóloga
                    </Link>
                </div>

                <div v-if="$page.props.auth.user.role == 2" class="action-group">
                    <Link :href="route('pacientes')" class="btn btn-secondary">
                        Pacientes
                    </Link>
                    <Link :href="route('agendas.index')" class="btn btn-secondary">
                        Agenda
                    </Link>
                </div>

                <div v-if="$page.props.auth.user.role == 1" class="action-group">
                    <Link :href="route('schedule.index')" class="btn btn-primary">
                        Marcar Consulta
                    </Link>
                    <Link :href="route('schedule.paciente')" class="btn btn-primary">
                        Meus Agendamentos
                    </Link>
                </div>
            </div>

            <div class="welcome-message">
                <p>
                    Bem-vindo à Clínica de Psicologia Xastre X-Ames.<br>
                    Estamos comprometidos em proporcionar um ambiente acolhedor e profissional para atender às suas necessidades emocionais e psicológicas.<br>
                    Nossa equipe está dedicada a oferecer o melhor atendimento e suporte para seu bem-estar.
                </p>
            </div>
        </AuthenticatedLayout>
    </div>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';

function voltarPagina() {
    window.history.back();
}
</script>

<style scoped>
.dashboard-container {
    max-width: 900px;
    margin: 0 auto;
    padding: 30px;
    background-color: #ffffff;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}
>>>>>>> Stashed changes

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

<<<<<<< Updated upstream
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">You're logged in!</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
=======
.dashboard-actions {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 30px;
}

.action-group {
    display: flex;
    flex-direction: column;
    align-items: center;
    margin-bottom: 20px;
}

.btn {
    display: inline-block;
    padding: 12px 25px;
    border-radius: 25px;
    text-decoration: none;
    font-size: 16px;
    margin: 5px 0;
    transition: background-color 0.3s, color 0.3s;
}

.btn-primary {
    background-color: #48bb78;
    color: #ffffff;
}

.btn-secondary {
    background-color: #48bb78;
    color: #ffffff;
}

.btn:hover {
    opacity: 0.8;
}

.welcome-message {
    padding: 20px;
    background-color: #f0f0f0;
    border-radius: 8px;
    text-align: center;
    font-size: 18px;
    line-height: 1.6;
    color: #666666;
}

.btn-back {
    background-color: #555;
    color: #fff;
    padding: 10px 20px;
    border: none;
    border-radius: 25px;
    cursor: pointer;
    margin-bottom: 20px;
    transition: background-color 0.3s, color 0.3s;
}

.btn-back:hover {
    opacity: 0.8;
}
</style>
>>>>>>> Stashed changes
