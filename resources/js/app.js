import './bootstrap';
import '../css/app.css';
import { createApp, h } from 'vue'
import { createInertiaApp, Head } from '@inertiajs/vue3'
import Toast from "vue-toastification";
import "vue-toastification/dist/index.css";

createInertiaApp({
    title: (title) => `RMS ${title}`,
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(Toast)
            .component('Head', Head)
            .mount(el)
    },
})
