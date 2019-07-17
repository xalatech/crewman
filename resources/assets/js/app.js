import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'
import HomeComponent from './components/HomeComponent'
import EmployeesComponent from './components/EmployeesComponent'
import ProfilesComponent from './components/ProfilesComponent'

Vue.component('employees-component', require('./components/EmployeesComponent.vue').default);

const router = new VueRouter({
    mode: 'history',
    routes: [{
        path: '/',
        name: 'home',
        component: HomeComponent
    },
    {
        path: '/employees',
        name: 'employees',
        component: EmployeesComponent
    },
    {
        path: '/profiles',
        name: 'profiles',
        component: ProfilesComponent
    },
],
});

const app = new Vue({
    el: '#app',
    components: {
        App
        },
    router,
});
