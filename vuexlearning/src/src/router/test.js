import Vue from 'vue'
import VueRouter from 'vue-router'
import pages from './pages'
import auth from './auth'
import errors from './errors'
import { Self } from "@/repositories/user.api";
import store from '@/store'
// import axios from '@/plugins/axios'
// import auth from './auth'
Vue.use(VueRouter)

const routes = [
    ...pages,
    ...auth,
    ...errors
]

const router = new VueRouter({
    // mode: 'history',
    base: process.env.BASE_URL,
    routes
})

function guardRoutes(to, next) {
    const guest_routes = [
        'login'
    ]
    if ((guest_routes.includes(to.name)) && localStorage.getItem('token') === '') {
        next()
    } else if (localStorage.getItem('token') === '') {
        next({ name: 'login' })
    } else if (guest_routes.includes(to.name)) {
        next({ name: 'dashboard' })
    } else {
        next()
    }
}

router.beforeEach((to, from, next) => {
    if (localStorage.getItem('token')) {
        Self().then(({ data }) => {
            store.commit('login', data)
            localStorage.setItem('token', data.access_token)
            guardRoutes(to, next)
        }).catch(err => {
            localStorage.removeItem('token')
            console.log(err)
        })
    } else {
        guardRoutes(to, next)
    }
})

export default router