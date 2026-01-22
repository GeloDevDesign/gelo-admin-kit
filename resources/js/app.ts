import './bootstrap';
import '../css/app.css';

import { createApp, h, DefineComponent } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { createPinia } from 'pinia'; 
import { ZiggyVue } from 'ziggy-js'; 


createInertiaApp({ 
  resolve: name => {
    const pages = import.meta.glob<DefineComponent>('./pages/**/*.vue', { eager: true });
    return pages[`./pages/${name}.vue`];
  },
  
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .use(createPinia())
      .use(ZiggyVue) 
      .mount(el);
  },
});
