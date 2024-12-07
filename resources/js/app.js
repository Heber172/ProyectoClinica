/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

// Componenten Inicial
import App from './components/MainApp.vue';

// Importamos AXIOS
import VueAxios from 'vue-axios';
import axios from 'axios';
Vue.use(VueAxios, axios);

// Importamos VUEX
import StoreData from './store.js'
import Vuex from 'vuex';
Vue.use(Vuex);
const store = new Vuex.Store(StoreData);

// Importamos y configuramos el Vue-router
import VueRouter from 'vue-router';
import { routes } from './routes';
import Vue from 'vue';
Vue.use(VueRouter);
const router = new VueRouter({
    mode: 'history',
    routes: routes
});

// Importamos Validación
import Vuelidate from 'vuelidate';
Vue.use(Vuelidate);

// Paginación para table
Vue.component('pagination', require('laravel-vue-pagination'))

// Carga de LOADER
import Loader from './components/loaders/Loader';
Vue.component('loader', Loader);
import LoaderTwo from './components/loaders/LoaderTwo';
Vue.component('loader-two', LoaderTwo);
import LoaderThree from './components/loaders/LoaderThree';
Vue.component('loader-three', LoaderThree);

// Componente Select2
import VueSelect from 'vue-select';
import 'vue-select/dist/vue-select.css';
Vue.component('v-select', VueSelect);

// Notificacion
import VueNoty from 'vuejs-noty'
import 'vuejs-noty/dist/vuejs-noty.css';
Vue.use(VueNoty);

// Configuración de vue-lazyload para Vue 2 (v1.3.3)
// Carga imágenes solo cuando son visibles en el viewport
import VueLazyload from 'vue-lazyload';
Vue.use(VueLazyload, {
    preLoad: 1.3,
    error: '/imagenes/images_sis/error.png',
    loading: '/imagenes/images_sis/loading.gif',
    attempt: 1
});

// Control de Rutas
import { inicializar } from './helpers/general.js';
inicializar(store, router);

const app = new Vue({
    router: router,
    store,
    render: h => h(App)
}).$mount('#app');
