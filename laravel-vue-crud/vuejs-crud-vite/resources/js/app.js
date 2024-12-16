import './bootstrap';
import { createApp } from 'vue';
import App from './components/App.vue';
import axios from 'axios';

// axios.defaults.baseURL = '/api';
createApp(App).mount('#app');