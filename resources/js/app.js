require('./bootstrap');

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';

import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
import moment from 'moment';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(VueSweetalert2)
            .mixin({ methods: { route } })
            .component('icon', require('./Components/Icon').default)
            .mount(el)
            .filter('timeAgo', function(created){
                return moment(created).fromNow();
            });
    },
});

InertiaProgress.init({ color: '#4B5563' });
