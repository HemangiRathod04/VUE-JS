import { createRouter, createWebHistory } from 'vue-router';
import DashboardComponent from '../component/Dashboard.vue';
import LoginComponent from '../component/Login.vue';
import RoleComponent from '../component/Role.vue';
import ShowRoleComponent from '../component/showRole.vue';
import UserComponent from '../component/User.vue';
import RegisterComponent from '../component/Register.vue';
import AddUserComponent from '../component/AddUser.vue';
import SubmitProperty from '../component/SubmitProperty.vue';

const routes = [
  {
    path: '/',
    redirect: '/login',
  },
  {
    path: '/login',
    name: 'Login',
    component: LoginComponent,
    meta:{title:'Login'}
  },
  {
    path: '/register',
    name:'Register',
    component:RegisterComponent,
    meta: { title: 'Register' }
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: DashboardComponent,
  },
  {
    path: '/roles',
    name: 'Roles',
    component: RoleComponent, 
  },
  {
    path: '/users',
    name: 'Users',
    component:UserComponent,
  },
  {
    path: '/user/add',
    name: 'AddUser',
    component:AddUserComponent,
  },
  {
    path: '/role/show/:id/permissions',
    name: 'RoleShow',
    component: ShowRoleComponent,
  },
  {
    path: '/submitproperty',
    name: 'SubmitProperty',
    component: SubmitProperty
  },
  { path: '/logout', redirect: { name: 'Login' } }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});



export default router;
