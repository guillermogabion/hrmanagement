import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from '@/store'
import vuetify from './plugins/vuetify'
import axios from '@/plugins/axios'
// import * as VeeValidate from 'vee-validate';
// import moment from 'moment'
// import general from '@/mixins/general'
// import VueChart from 'vue-chart-js'
// import titleMixin from './mixins/titleMixin'

// Vue.mixin(titleMixin)

// Vue.prototype.moment = moment

// Vue.config.productionTip = false
// Vue.use(VeeValidate)

// Vue.use(VueChart)
// Vue.mixin(general)

new Vue({
    router,
    vuetify,
    axios,
    store,
    render: h => h(App),
}).$mount('#app')