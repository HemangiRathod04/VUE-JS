import './bootstrap';
import '../css/app.css';
import { createApp } from 'vue';
import router from './routes/index.js';
import App from './layout/app.vue';

import HelloWorldComponent from './components/HelloWorldComponent.vue';
import SideBarComponent from './components/SideBarComponent.vue';
import NavBarComponent from './components/NavBarComponent.vue';

const app = createApp(App);
app.component('navbar-component', NavBarComponent);
app.component('sidebar-component',SideBarComponent);

app.use(router);
app.mount('#app');
