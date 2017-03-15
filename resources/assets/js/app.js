import Vue from "vue";
import axios from "axios";
import VueAxios from "vue-axios";

require('./bootstrap');

// Adding the X-CSRF-Token to all axios request
axios.interceptors.request.use(function(config){
  config.headers['X-CSRF-TOKEN'] = window.Laravel.csrfToken
  return config
})

window.eventBus = new Vue()

// Making axios available as $http
// so that the ajax calls are not axios dependent
Vue.prototype.$http = axios

Vue.use(VueAxios, axios)

Vue.component('vuecrud', require('./components/VueCRUD'));

const app = new Vue({
    el: '#app'
});
