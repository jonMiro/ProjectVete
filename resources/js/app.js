import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

const appName = import.meta.env.VITE_APP_NAME || "Vet&Care";

createInertiaApp({
    title: (title) => `${title} - Vet&Care`,

    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),

    // favicon
    setup({ el, App, props, plugin }) {
        const faviconLink = document.createElement("link");
        faviconLink.rel = "icon";
        faviconLink.href = "/images/logo.webp"; //ruta images
        document.head.appendChild(faviconLink);

        //Font Awesome CDN
        const fontAwesomeLink = document.createElement("link");
        fontAwesomeLink.rel = "stylesheet";
        fontAwesomeLink.href =
            "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css";
        document.head.appendChild(fontAwesomeLink);

        //Crear app
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },

    progress: {
        color: "#4B5563",
    },
});
