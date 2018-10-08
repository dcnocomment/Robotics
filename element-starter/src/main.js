import Vue from 'vue';
import App from './App';
import router from './router';
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

import VueResource from 'vue-resource';
import http from 'vue-resource';


Vue.use(ElementUI);
Vue.use(VueResource);
Vue.config.productionTip = false;

Vue.use(http);
Vue.http.options.emulateJSON = false;



Vue.http.interceptors.push((request, next) => {
    request.credentials = true;
    next();
});


new Vue({
    el: '#app',
    router,
    render: h => h(App),
})
