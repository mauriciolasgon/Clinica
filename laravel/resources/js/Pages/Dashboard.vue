<template>
    <div class="dashboard-container">
        <h1 class="dashboard-title">Dashboard</h1>

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

.dashboard-title {
    font-size: 36px;
    margin-bottom: 20px;
    color: #333333;
    text-align: center;
}

.dashboard-subtitle {
    font-size: 28px;
    margin-bottom: 20px;
    color: #555555;
    text-align: center;
}

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
    background-color: #4a90e2;
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
</style>
