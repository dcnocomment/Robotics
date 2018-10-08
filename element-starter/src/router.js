import Vue from 'vue'
import Router from 'vue-router'

import App from './App.vue';
import Platform from './Platform.vue';
import Welcome from './Welcome.vue';
import Wedding from './Wedding.vue';

Vue.use(Router)

export default new Router({
    //mode: 'history',
    //base: __dirname,
    routes: [
        {name: 'wedding', path: '/wedding', component: Wedding},
        {name: 'welcome', path: '/welcome', component: Welcome},
        {name: 'platform', path: '/platform', component: Platform}
    ]
})
