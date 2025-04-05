import "./bootstrap";
import "../css/app.css";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy";

// Establecer el nombre de la aplicación
const appName = import.meta.env.VITE_APP_NAME || "Vet&Care";

// Cambiar el título de la página y agregar "- Vet&Care"
createInertiaApp({
    title: (title) => `${title} - Vet&Care`, // Cambié la parte del título a "Vet&Care"

    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),

    // Configuración del favicon
    setup({ el, App, props, plugin }) {
        // Cambiar favicon
        const faviconLink = document.createElement("link");
        faviconLink.rel = "icon";
        faviconLink.href = "/images/logo.webp"; // Ruta del favicon en public/images
        document.head.appendChild(faviconLink);

        // Crear la app
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },

    progress: {
        color: "#4B5563",
    },
});
