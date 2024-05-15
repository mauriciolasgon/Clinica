<template>
    <div>
        <h1>Create Schedule</h1>
        <form @submit.prevent="createSchedule">
            <div>
                <label>Title:</label>
                <input v-model="title" type="text" />
            </div>
            <div>
                <label>Date:</label>
                <input v-model="date" type="date" />
            </div>
            <button type="submit">Create</button>
        </form>
    </div>
</template>

<script>
export default {
    name: 'ScheduleCreate',
    data() {
        return {
            title: '',
            date: ''
        };
    },
    methods: {
        createSchedule() {
            axios.post('/api/schedules', { title: this.title, date: this.date })
                .then(response => {
                    this.$router.push({ name: 'schedule.index' });
                });
        }
    }
};
</script>
