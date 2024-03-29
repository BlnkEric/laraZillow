import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/inertia-vue3'
import MainLayout from '@/Layouts/MainLayout.vue'
import Icon from '@/Components/Icon.vue'

import { library } from '@fortawesome/fontawesome-svg-core'
import { faHatWizard, faCamera, faCheckCircle, faSpinner, faBell } from '@fortawesome/free-solid-svg-icons'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { ZiggyVue } from 'ziggy'
import { InertiaProgress } from '@inertiajs/progress'
// const camera = icon({ prefix: 'fas', iconName: 'camera' })
import '../css/app.css'

library.add(faCamera, faCheckCircle, faSpinner, faBell)
library.add(faHatWizard)
InertiaProgress.init({
    delay: 0,
    color: '#29d',
    includeCSS: true,
    showSpinner: true,
})
createInertiaApp({
    resolve: async (name) => {
        const pages = import.meta.glob('./Pages/**/*.vue')

        const page = await pages[`./Pages/${name}.vue`]()
        page.default.layout = page.default.layout || MainLayout
        return page
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .component('font-awesome-icon', FontAwesomeIcon)
            .component('icon', Icon)
            .mount(el)
        // app.component('FontAwesomeIcon', FontAwesomeIcon)

    },
})

