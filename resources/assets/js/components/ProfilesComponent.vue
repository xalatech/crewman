<template>
  <div class="card card-default">
    <div class="card-header">
      <span v-if="employee">{{ employee.first_name }} {{ employee.last_name }} - Employment Profile</span>
    </div>
  <div class="card-body">
    <div class="loading" v-if="loading">Loading...</div>
    <div v-if="error" class="error">{{ error }}</div>
    <div class="card card-default">
        <div class="card-header">
            Employments history
        </div>
        <div class="card-body">
            <div v-if="employee && employee.employments">

            <div v-for="employment in employee.employments" :key="employment.id">
                <div class="mt-10" v-if="employment.current">
                    Current Employment
                </div>
                <div class="mt-10" v-else>
                    Other Employments
                </div>

                <p>Title: {{employment.title}}</p>
                <p>Description: {{employment.description}}</p>
                <p>Start Date: {{employment.start_date}}</p>
                <p>End Date: {{employment.end_date}}</p>
                <p>Employer: {{employment.employer}}</p>

            <a v-bind:href="'#assignments_' + employment.id" class="btn btn-primary" data-toggle="collapse">Assignments</a>
            <div v-bind:id="'assignments_' + employment.id" class="collapse">
               <div v-if="employment && employment.assignments">
                   <div v-for="assignment in employment.assignments" :key="assignment.id">
                        <p>Title: {{assignment.title}}</p>
                   </div>
               </div>
            </div>
</div>
        </div>
    </div>

    </div>
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
            this.employee = res.employee;
            this.loading = false;
        })
        .catch(err => this.error = error);
    }
  }
};
</script>
