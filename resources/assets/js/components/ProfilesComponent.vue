<template>
  <div class="card card-default">
    <div class="card-header">
      List of OSM Aviation Employees
    </div>
  <div class="card-body">
    <div class="loading" v-if="loading">Loading...</div>
    
      <div v-if="error" class="error">{{ error }}</div>
    </div>
  </div>
</template>
<script>
export default {
    mounted() {},
    data() {
    return {
      loading: false,
      employee: null,
      employee_id: this.$route.params.employee_id,
      error: null
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
        this.loading = true;
        fetch('/api/employees/profile/' + this.employee_id)
        .then(res => res.json())
        .then(res => {
            console.log(res);
            this.employee = res;
            this.loading = false;
        })
        .catch(err => this.error = error);
    }
  }
};
</script>
