import Vue from 'vue'
import Router from 'vue-router'
import Login from './views/Login.vue'
import Home from './views/Home.vue'
import About from './views/About.vue'
import Hello from './views/Hello.vue'
import Customer from './views/Customer.vue'
import Product from './views/Product.vue'
import User from './models/user'

Vue.use(Router)

const router = new Router({
  routes: [
    {
      path: '/',
      name: 'home',
      component: Home
    },
    {
      path: '/login',
      name: 'login',
      component: Login
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
    },
    {
      path: '/product',
      name: 'product',
      component: Product
    },
    {
      path: '/product/:id',
      name: 'product_detail',
      component: Product
    }
  ]
})

router.beforeEach((to, from, next) => {
  fetch(`/api/user/current.php`, { credentials: 'include' })
    .then(res => res.json() as Promise<User>)
    .then(user => {
      if (user.id != null) {
        localStorage.setItem('admin', user.is_admin);
        localStorage.setItem('username', user.username);
        if (to.name == 'login') {
          next('/');
        } else {
          next();
        }
      } else {
        throw "Invalid user";
      }
    })
    .catch(error => {
      if (to.name == 'login') {
        next();
      } else {
        next('login');
      }
    })
});

export default router;