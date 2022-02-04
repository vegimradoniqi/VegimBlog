import Home from  './components/Home';
import Login from './components/Login/Login';
import Register from './components/Login/Register';
import Dashboard from "./components/Dashboard/Dashboard";
import VerifyEmail from "./components/Login/VerifyEmail";
import Blogs from "./components/Dashboard/Blogs";
import Users from "./components/Dashboard/Users";
import AfterRegister from "./components/Login/AfterRegister";

export default {
    mode: 'history',

    routes: [
        {
            path: '/',
            component: Home,
            name: 'Home'
        },
        {
            path: '/login',
            component: Login,
            name: 'Login'
        },
        {
            path: '/register',
            component: Register
        },
        {
            path: '/dashboard',
            component: Dashboard,
            name: 'Dashboard',
            beforeEnter:(to, from, next) => {
                axios.get('/api/authenticated').then(() => {
                    next()
                }).catch(()=>{
                    return next({name: 'Login'})
                })
            }
        },
        {
            path: '/blogs-manage',
            component: Blogs,
            name: 'Blogs',
            beforeEnter:(to, from, next) => {
                axios.get('/api/authenticated').then(() => {
                    next()
                }).catch(()=>{
                    return next({name: 'Login'})
                })
            }
        },
        {
            path: '/users-manage',
            component: Users,
            name: 'Users',
            beforeEnter:(to, from, next) => {
                axios.get('/api/authenticated').then(() => {
                    next()
                }).catch(()=>{
                    return next({name: 'Login'})
                })
            }
        },
        {
            path: '/after-register',
            component: AfterRegister,
            name: 'AfterRegister'
        },
        {
            path: '/verify-email',
            component: VerifyEmail,
            name: 'VerifyEmail'
        },
    ]
}
