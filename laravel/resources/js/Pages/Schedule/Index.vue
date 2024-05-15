<template>
    <div>
        <h1>Agendamentos</h1>
        <ul>
            <li v-if="$page.props.auth.user.role == 2" 
            v-for="schedule in schedules" :key="schedule.id">
                {{ schedule.title }} - {{ schedule.date }}
                <a :href="`api/schedules/${schedule.id}/edit`">Editar</a>
                <form :action="`api/schedules/${schedule.id}`" method="POST" @submit.prevent="deleteSchedule(schedule.id)">
                    <input type="hidden" name="_method" value="DELETE">
                    <button type="submit">Excluir</button>
                </form>
            </li>
        </ul>
        <a href="api/schedules/create">Criar Novo Agendamento</a>
    </div>
</template>

<script>
export default {
    props: {
        schedules: Array
    },
    methods: {
        deleteSchedule(id) {
            axios.delete(`api/schedules/${id}`).then(response => {
                window.location.reload();
            });
        }
    }
}
</script>
