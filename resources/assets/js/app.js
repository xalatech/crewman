import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

import App from './views/App'
import Home from './views/Home'

Vue.component('employees-component', require('./components/EmployeesComponent.vue').default);

const router = new VueRouter({
    mode: 'history',
    routes: [{
        path: '/',
        name: 'home',
        component: Home
    }, ],
});

const app = new Vue({
    el: '#app',
    components: {
        App
    },
    router,
});
