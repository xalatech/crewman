import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'

Vue.use(VueRouter)

import App from './views/App'
import Home from './views/Home'
import EmployeesIndex from './views/EmployeesIndex'

const router = new VueRouter({
    mode: 'history',
    routes: [{
        path: '/',
        name: 'home',
        component: Home
    },
    {
        path: '/employees',
        name: 'employee.index',
        component: EmployeesIndex,
    }, ],
});

const app = new Vue({
    el: '#app',
    components: {
        App
    },
    router,
});
