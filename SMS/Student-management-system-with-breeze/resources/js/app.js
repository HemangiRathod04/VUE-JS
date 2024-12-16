import './bootstrap';
import '../css/app.css';
// import ConfirmPassword from './pages/Auth/ConfirmPassword.vue';


// import { createApp, h } from 'vue';
// import { createInertiaApp } from '@inertiajs/vue3';
// import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
// import { ZiggyVue } from '../../vendor/tightenco/ziggy';

// const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

// createInertiaApp({
//     title: (title) => `${title} - ${appName}`,
//     resolve: (name) => resolvePageComponent(`./pages/Auth/ConfirmPassword.vue`),
//     setup({ el, App, props, plugin }) {
//         return createApp({ render: () => h(App, props) })
//             .use(plugin)
//             .use(ZiggyVue)
//             .mount(el);
//     },
//     progress: {
//         color: '#4B5563',
//     },
// });

import { createApp, h } from 'vue'

import { createInertiaApp } from '@inertiajs/inertia-vue3'

// import { InertiaProgress } from '@inertiajs/progress'

// InertiaProgress.init()

createInertiaApp({

  resolve: name => import(`./pages/Auth/${name}.vue`),

  setup({ el, App, props, plugin }) {

    createApp({ render: () => h(App, props) })

      .use(plugin)

      .mount(el)

  },

})

