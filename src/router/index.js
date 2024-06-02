import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/login/UserLogin.vue';
import HomeDashboard from '../components/HomeDashboard.vue';
import UserRegister from '@/components/register/UserRegister.vue';
import FaqPage from '@/components/FAQ/FaqPage.vue';


const routes = [
  {
    path: '/',
    name: 'Login',
    component: Login
  },
  {
    path: '/dashboard',
    name: 'HomeDashboard',
    component: HomeDashboard
  },
  {
    path: '/register',
    name: 'UserRegister',
    component: UserRegister
  },

  {
    path: '/faq',
    name: 'FaqPage',
    component: FaqPage
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
