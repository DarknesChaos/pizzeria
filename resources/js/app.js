require('./bootstrap');

window.Vue = require('vue');

window.VueRouter = require('vue-router').default;

window.VueAxios = require('vue-axios').default;

window.Axios = require('axios').default;

let AppLayout = require('./components/App').default;

const Orders = Vue.component('orders', require('./components/OrderComponent').default);
const Create = Vue.component('create', require('./components/CreateOrderComponent').default);

Vue.use(VueRouter, VueAxios, axios);

const routes = [
    {
        name: 'orders',
        path: '/',
        component: Orders
    },
    {
        name: 'orders.create',
        path: '/create-order',
        component: Create
    }
];

const router = new VueRouter({mode: 'history', routes: routes});

new Vue(
    Vue.util.extend(
        { router },
        AppLayout
    )
).$mount('#app');
