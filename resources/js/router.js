import VueRouter from 'vue-router'
// Pages
import Home from './components/Home/Home'
import Hello from './components/Hello'
import UsersIndex from './components/UsersIndex'
import UserLogin from './components/Auth/UserLogin'
import UserRegister from './components/Auth/UserRegister'
// Routes
const routes = [
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
        meta: {
            auth: false
        }
    },
    {
        path: '/user/register',
        name: 'user.register',
        component: UserRegister,
        meta: {
            auth: false
        }
    },
    {
        path: '/users',
        name: 'users.index',
        component: UsersIndex,
        meta: {
            auth: true
        }
    },
];

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
});

export default router;
