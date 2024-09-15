import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3'
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';

import TheAdminLayout from "@/components/admin/layouts/TheAdminLayout.vue"
import TheApplicantLayout from "@/components/applicant/layouts/TheApplicantLayout.vue"

import { createPinia } from 'pinia'
const pinia = createPinia()

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';


createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: async name => {
        const page = await resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'))
        if (page.default.layout === undefined) {
            if (name.startsWith("Admin")) {
                page.default.layout = TheAdminLayout;
            } else if (name.startsWith("Student")) {
                page.default.layout = TheApplicantLayout;
            } else if (name.startsWith("Applicant")) {
                page.default.layout = TheApplicantLayout;

            }
        }
        return page;
    },
    progress: {
        showSpinner: true,
    },
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(pinia)
            .use(ZiggyVue, Ziggy)
            .mount(el);
    },
});

