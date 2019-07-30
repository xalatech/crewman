<template>
  <div v-if="employee">
        <h1>{{ employee.first_name }} {{ employee.last_name }} - Employment Profile</h1>
  <div class="card card-default">
    <div class="card-header">
      Employment History
    </div>
  <div class="card-body">
    <div class="loading" v-if="loading">Loading...</div>
    <div v-if="error" class="error">{{ error }}</div>
            <div v-if="employee && employee.employments">
<ul class="list-group employments">
  <li v-for="employment in employee.employments" :key="employment.id" 
    v-bind:class="[listItemClass, (employment.current) ? listItemCurrnetClass : '']">
                <p>{{employment.title}}</p>
                <p><strong>{{employment.employer}}</strong></p>
                <p>{{employment.start_date}} - {{employment.current ? 'Current' : employment.end_date}}</p>
              
            <div v-if="employment && employment.assignments">
        
            <a v-bind:href="'#assignments_' + employment.id" class="btn btn-primary" data-toggle="collapse">Assignments</a>
            <div v-bind:id="'assignments_' + employment.id" class="collapse">
            <div class="card card-body mt-3">
                
                          <table class="table table-striped table-bordered" v-if="employment.assignments">
        <thead>
        <tr>
          <th>Assignment</th>
          <th>Additional info</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="assignment in employment.assignments" :key="assignment.id">
          <td width="60%"> {{ assignment.title }} </td>
          <td width="40%">
           <div v-if="assignment.locations">  
            <a v-bind:href="'#locations_' + assignment.id" class="btn btn-info" data-toggle="collapse">View Locations</a>
              <div v-bind:id="'locations_' + assignment.id" class="collapse">
                <ul>
                  <li v-for="location in assignment.locations" :key="location.id">{{location.country}}</li>
                </ul>
              </div>
           </div>
            
          </td>
        </tr>
        </tbody>
      </table>
                   
            </div>
            </div>
                           </div>

          
   
    
    </li>
</ul>
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
      error: null,
      listItemClass: 'list-group-item',
      listItemCurrnetClass: 'list-group-item-primary'
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
