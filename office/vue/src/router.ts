import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import About from './views/About.vue'
import Hello from './views/Hello.vue'
import Customer from './views/Customer.vue'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/about',
      name: 'about',
      component: About
    },
    {
      path: '/customer',
      name: 'customer',
      component: Customer
    },
    {
      path: '/customer/:id',
      name: 'customer_detail',
      component: Customer
    }
  ]
})
