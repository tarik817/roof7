
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'

Vue.use(VueRouter);

import App from './components/App'
import Home from './components/Home/Home'
import Hello from './components/Hello'
import UsersIndex from './components/UsersIndex'
import UserLogin from './components/Auth/UserLogin'
import UserRegister from './components/Auth/UserRegister'

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/hello',
            name: 'hello',
            component: Hello,
        },
        {
            path: '/user/login',
            name: 'user.login',
            component: UserLogin,
        },
        {
            path: '/user/register',
            name: 'user.register',
            component: UserRegister,
        },
        {
            path: '/users',
            name: 'users.index',
            component: UsersIndex,
        },
    ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
});
