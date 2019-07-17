<template>
    <div class="employees">
        <div class="loading" v-if="loading">
            Loading...
        </div>

        <div v-if="error" class="error">
            {{ error }}
        </div>

        <ul v-if="employees">
            <li :for="{ first_name, last_name } in employees">
                <strong>Name:</strong> {{ first_name }},
                <strong>Email:</strong> {{ last_name }}
            </li>
        </ul>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            loading: false,
            employees: null,
            error: null,
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.error = this.employees = null;
            this.loading = true;
            axios
                .get('/api/employees')
                .then(response => {
                    this.employees = response;
                });
        }
    }
}
</script>