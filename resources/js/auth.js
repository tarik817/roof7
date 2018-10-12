import bearer from '@websanova/vue-auth/drivers/auth/bearer'
import axios from '@websanova/vue-auth/drivers/http/axios.1.x'
import router from '@websanova/vue-auth/drivers/router/vue-router.2.x'
// Auth base configuration some of this options
// can be override in method calls
const config = {
    auth: bearer,
    http: axios,
    router: router,
    tokenDefaultName: 'cool-token',
    tokenStore: ['localStorage'],
    rolesVar: 'role',
    registerData: {
        url: '/user/register',
        method: 'POST',
        redirect: '/user/login'
    },
    loginData: {
        url: '/user/login',
        method: 'POST',
        redirect: '',
        fetchUser: true
    },
    logoutData: {
        url: '/user/logout',
        method: 'POST',
        redirect: '/user/login',
        makeRequest: true
    },
    fetchData: {
        url: '/user/user',
        method: 'GET',
        enabled: true
    },
    refreshData: {
        url: '/user/refresh',
        method: 'GET',
        enabled: true,
        interval: 30
    },
    authRedirect: {
        name: 'user.login'
    }
};
export default config;
