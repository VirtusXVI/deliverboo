import Vue from 'vue'
import VueRouter from 'vue-router'
Vue.use(VueRouter)


import HomePage from './pages/HomePage.vue';
import Categories from './pages/Categories.vue';

const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'home',
            component: HomePage
        },
        {
            path: '/categorie',
            name: 'categorie',
            component: Categories
        }
    ]
});

export default router;