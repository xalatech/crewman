<template>
  <div class="card card-default">
    <div class="card-header">
      List of OSM Aviation Employees
    </div>
  <div class="card-body">
    <div class="loading" v-if="loading">Loading...</div>
      <table class="table table-striped table-bordered" v-if="employees">
        <thead>
        <tr>
          <th>OSMA ID #</th>
          <th>Firstname</th>
          <th>Lastname</th>
          <th>Current Employer</th>
          <th>Employment History</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="employee in employees" :key="employee.id">
          <td width="15%"> {{ employee.id }} </td>
          <td width="20%"> {{ employee.first_name }} </td>
          <td width="20%"> {{ employee.last_name }} </td>
          <td width="20%">
              <span v-if="employee.employer">{{ employee.employer }} </span>
              <span v-else class="danger"> Inactive </span>
          </td>
          <td width="20%">
              <span v-if="employee.employer"><router-link class="btn btn-info" v-bind:to="'/profiles/' + employee.id">Show profile</router-link></span>
          </td>
        </tr>
        </tbody>
      </table>
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
      employees: [],
      error: null
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
        this.loading = true;
        fetch('api/employees')
        .then(res => res.json())
        .then(res => {
            this.employees = res;
            this.loading = false;
        })
        .catch(err => this.error = error);
    }
  }
};
</script>
