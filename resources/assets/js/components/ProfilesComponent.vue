<template>
  <div v-if="employee">
    <h1>{{ employee.first_name }} {{ employee.last_name }} - Employment Profile</h1>
    <div class="card card-default">
      <div class="card-header">Employment History</div>
      <div class="card-body">
        <div class="loading" v-if="loading">Loading...</div>
        <div v-if="error" class="error">{{ error }}</div>
        <div v-if="employee && employee.employments">
          <ul class="list-group employments">
            <li
              v-for="employment in employee.employments"
              :key="employment.id"
              v-bind:class="[listItemClass, (employment.current) ? listItemCurrnetClass : '']"
            >
              <div class="container">
                <div class="row">
                  <div class="col-sm">{{employment.title}}</div>
                  <div class="col-sm font-weight-bold">{{employment.employer}}</div>
                  <div
                    class="col-sm"
                  >{{employment.start_date}} - {{employment.current ? 'Current' : employment.end_date}}</div>
                  <div class="col-sm">
                    <a
                      v-bind:href="'#assignments_' + employment.id"
                      class="btn btn-sm btn-primary"
                      data-toggle="collapse"
                    >View assignments</a>
                  </div>
                </div>
              </div>
              <div v-if="employment && employment.assignments">
                <div v-bind:id="'assignments_' + employment.id" class="collapse">
                  <div class="card card-body mt-3">
                    <div v-for="assignment in employment.assignments" :key="assignment.id">
                      <div class="row mt-2">
                        <div class="col-sm-8">{{assignment.title}}</div>
                        <div class="col-sm">
                          <a
                            v-bind:href="'#locations_' + assignment.id"
                            class="btn btn-sm btn-primary"
                            data-toggle="collapse"
                          >Locations</a>
                        </div>
                        <div class="col-sm">
                          <a
                            v-bind:href="'#roles_' + assignment.id"
                            class="btn btn-sm btn-info"
                            data-toggle="collapse"
                          >Roles</a>
                        </div>
                        <div class="col-sm">
                          <a
                            v-bind:href="'#leaves_' + assignment.id"
                            class="btn btn-sm btn-secondary"
                            data-toggle="collapse"
                          >Leaves</a>
                        </div>
                      </div>

                      <div v-if="assignment.locations">
                        <div v-bind:id="'locations_' + assignment.id" class="collapse">
                          <table class="table table-striped table-bordered mt-3">
                            <thead>
                              <tr>
                                <th>Country</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr v-for="location in assignment.locations" :key="location.id">
                                <td>{{location.country}}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div v-if="assignment.roles">
                        <div v-bind:id="'roles_' + assignment.id" class="collapse">
                          <table class="table table-striped table-bordered mt-3">
                            <thead>
                              <tr>
                                <th>Role</th>
                                <th>Duration</th>
                                <th>Role type</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr v-for="role in assignment.roles" :key="role.id">
                                <td width="50%">{{role.title}}</td>
                                <td width="30%">{{role.start_date}} - {{role.end_date}}</td>
                                <td width="20%">{{role.role_type}}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <div v-if="assignment.leaves">
                        <div v-bind:id="'leaves_' + assignment.id" class="collapse">
                           <table class="table table-striped table-bordered mt-3">
                            <thead>
                              <tr>
                                <th>Description</th>
                                <th>Duration</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr v-for="leave in assignment.leaves" :key="leave.id">
                                <td width="70%">{{leave.description}}</td>
                                <td width="30%">{{leave.start_date}} - {{leave.end_date}}</td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
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
      listItemClass: "list-group-item",
      listItemCurrnetClass: "list-group-item-primary"
    };
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      this.loading = true;
      fetch("/api/employees/profile/" + this.employee_id)
        .then(res => res.json())
        .then(res => {
          this.employee = res.employee;
          this.loading = false;
        })
        .catch(err => (this.error = error));
    }
  }
};
</script>
