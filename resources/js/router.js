import Vue from 'vue'
import VueRouter from 'vue-router'
import HomePage from './components/pages/HomePage.vue'
import RestaurantPage from './components/pages/RestaurantPage.vue'
import AboutPage from './components/pages/AboutPage.vue'
import NotFoundPage from './components/pages/NotFoundPage.vue'
import PolicyPage from './components/pages/PolicyPage.vue'
import CheckoutPage from './components/pages/CheckoutPage.vue'

Vue.use(VueRouter)

const routes = new VueRouter({
    mode: 'history',
    // linkExactActiveClass: 'active',
    routes: [
        { path: '/', component: HomePage, name: 'home' },
        { path: '/restaurants/:id', component: RestaurantPage, name: 'restaurant-page' },
        // { path: '/contacts', component: ContactsPage, name: 'contacts' },
        // { path: '/posts/:slug', component: PostDetailPage, name: 'post-detail' },
        { path: '*', component: NotFoundPage, name: 'not-found' },
        { path: '/about', component: AboutPage, name: 'about' },
        { path: '/policy', component: PolicyPage, name: 'policy' },
        {path:'/checkout', component: CheckoutPage, name: 'checkout'}
    ]
});

export default routes;