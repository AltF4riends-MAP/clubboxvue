import { createRouter, createWebHistory } from 'vue-router';
import Login from '../components/login/UserLogin.vue';
import HomeDashboard from '../components/HomeDashboard.vue';
import UserRegister from '@/components/register/UserRegister.vue';
import FaqPage from '@/components/FAQ/FaqPage.vue';
import CalendarPage from '@/components/event/CalendarPage.vue';
import ClubPage from '@/components/club/ClubPage.vue';
import CartPage from '@/components/cart/CartPage.vue';
import ManageProfile from '@/components/ManageProfile/ManageProfile.vue';


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
    path: '/club',
    name: 'ClubPage',
    component: ClubPage
  },

  {
    path: '/cart',
    name: 'CartPage',
    component: CartPage,
    props: route => ({ cart: route.query.cart })
  },

  {
    path: '/faq',
    name: 'FaqPage',
    component: FaqPage
  },

  {
    path: '/calendar',
    name: 'CalendarPage',
    component: CalendarPage
  },

  {
    path: '/profile',
    name: 'ManageProfile',
    component: ManageProfile
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
