import './bootstrap';
import '../css/app.css';
import 'vue-material-design-icons/styles.css';
import setupLocatorUI from "@locator/runtime";

import { createApp, h } from 'vue';
import {createInertiaApp, router} from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import MenuIcon from 'vue-material-design-icons/Menu.vue';
import { ZiggyVue } from 'ziggy-js';

import NProgress from 'nprogress'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';
router.on('start', () => NProgress.start());
router.on('finish', () => NProgress.done());

if (process.env.NODE_ENV === "development") {
    setupLocatorUI({
        adapter: "vue"
    });
}

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    progress: {
        color: 'red',
        showSpinner: false
    },
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('menu-icon', MenuIcon)
            .mount(el);
    },
});
