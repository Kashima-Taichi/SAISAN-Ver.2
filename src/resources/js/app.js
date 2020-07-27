/**
 * 独自で実装したComponentを下記にて取り込む
 */
import VueRouter from 'vue-router';
import HeaderComponent from "./components/HeaderComponent";
import MenuComponent from "./components/MenuComponent";
import CostMenuComponent from "./components/cost/CostMenuComponent";

/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

Vue.use(VueRouter);

const router = new VueRouter({
    mode: 'history',
    routes: [
        /*
        |--------------------------------------------------------------------------
        | Menu routes
        |--------------------------------------------------------------------------
        | メニュー関係のルーティングは下記にて実装
        |
        */
        {
            path: '/menus',
            name: 'saisan.menus',
            component: MenuComponent
        },
        /*
        |--------------------------------------------------------------------------
        | Cost routes
        |--------------------------------------------------------------------------
        | 経費ノ部のルーティングは下記にて実装
        |
        */
        {
            path: '/cost',
            name: 'saisan.cost',
            component: CostMenuComponent
        },

    ]
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('header-component', HeaderComponent);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
