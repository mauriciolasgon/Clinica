<template>
    <div>
        <h1>Editar Agendamento</h1>
        <form :action="`api/schedules/${schedule.id}`" method="POST">
            <input type="hidden" name="_method" value="PUT">

            <label for="title">Título</label>
            <input type="text" id="title" name="title" v-model="schedule.title" required>

            <label for="date">Data</label>
            <input type="date" id="date" name="date" v-model="schedule.date" required>

            <button type="submit">Salvar</button>
        </form>
    </div>
</template>

<script>
export default {
    props: {
        schedule: Object
    }
}
</script>
