import { createApp } from 'vue';
import App from './component/app.vue';
import router from './router';
import 'bootstrap/dist/css/bootstrap.min.css';
import '@fortawesome/fontawesome-free/css/all.min.css';

const app= createApp(App);
router.beforeEach((to,from,next)=>{
if(to.meta.title){
    document.title =to.meta.title;
}else{
    document.title = 'Laravel + Vue'; 
}
next();
});
app.use(router)
app.mount('#app');
