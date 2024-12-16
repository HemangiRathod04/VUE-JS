import { createWebHistory, createRouter, routerKey } from "vue-router";
import Dashboard from '../pages/dashboard/Dashboard.vue';
import Students from '../pages/students/Students.vue';
import CreateStudent from '../pages/students/CreateStudents.vue';
import Parents from '../pages/parents/parents.vue';
import CreateParents from '../pages/parents/CreateParents.vue';
import Teachers from '../pages/teachers/Teachers.vue';
import CreateTeacher from '../pages/teachers/CreateTeacher.vue';
import Classes from '../pages/classes/Classes.vue';
import CreateClass from '../pages/classes/CreateClass.vue';
import Attendances from '../pages/attandances/Attandances.vue';
import AttendanceCreate from '../pages/attandances/AttandanceCreate.vue';
import StudentView from "../pages/students/StudentView.vue";
import Schedules from "../pages/schedules/Schedules.vue";
import Register from '../pages/Auth/RegisterForm.vue';
import LoginForm from '../pages/Auth/LoginForm.vue';

// function isAuthenticated() {
//     return false; 
// }

const routes = [

    // {
    //     path:'/',
    //     name:'login',
    //     component: LoginForm  
    // },
    {
        path: '/dashboard',
        name: 'Dashboard',
        component: Dashboard
    },
    // {
    //     path: '/register',
    //     name: 'Register',
    //     component:Register
    // },
    {
        path: '/students',
        name: 'Students',
        component: Students
    },
    {
        path: '/students/create',
        name: 'CreateStudent',
        component: CreateStudent
    },
    {
        path: '/students/view/:id',
        name: 'StudentView',
        component: StudentView,
        props: true
    },
    {
        path: '/teachers',
        name: 'Teachers',
        component: Teachers
    },
    {
        path: '/teachers/create',
        name: 'CreateTeacher',
        component: CreateTeacher
    },
    {
        path: '/parents',
        name: 'Parents',
        component: Parents
    },
    {
        path: '/parents/create',
        name: 'CreateParents',
        component: CreateParents
    },
    {
        path: '/classes',
        name: 'Classes',
        component: Classes
    },
    {
        path: '/classes/create',
        name: 'CreateClass',
        component: CreateClass
    },
    {
        path: '/attandances',
        name: 'Attendances',
        component: Attendances
    },
    {
        path: '/Attendance/create',
        name: 'AttendanceCreate',
        component: AttendanceCreate
    },
    {
        path: '/schedules',
        name: 'Schedules',
        component: Schedules
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

// router.beforeEach((to, from, next) => {
//     if (to.matched.some(record => record.meta.requiresAuth)) {
//       if (!isAuthenticated()) {
//         next({ name: 'login' });
//       } else {
//         next();
//       }
//     } else {
//       next();
//     }
//   });

export default router;
