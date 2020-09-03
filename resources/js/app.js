/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('food-show', require('./components/FoodShow.vue').default);
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);
// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

import FoodShow from './components/FoodShow.vue';
import Vuex from 'vuex';
Vue.use(Vuex);

import { store } from './store/index.js';
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store,
    components: {
        'food-show': FoodShow
    },
    
});


// import Products from './components/Products.vue';

// import VueRouter from 'vue-router';

// Vue.use(VueRouter);


// const routes = [    
//     {
//         path: '/examplecomponent',
//         component: ExampleComponent
//     },
//     {
//         path: '/products',
//         component: Products
//     }
// ];

// const router = new VueRouter({
//     routes
// });

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
//     store,
//     router,
//     components: {
//         'example-component': ExampleComponent,
//         'products': Products
//     }
// });

