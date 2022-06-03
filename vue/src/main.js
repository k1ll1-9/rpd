import {createApp} from 'vue'
import App from './App.vue'
import 'jquery/src/jquery.js'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap/dist/js/bootstrap.min.js'
import VueAxios from 'vue-axios'
import axios from 'axios'
import store from './store'
import { BootstrapIconsPlugin } from 'bootstrap-icons-vue';
import router from './router/router'
import dayjs from 'dayjs'

//import SockJS from "sockjs-client";
//import Stomp from "webstomp-client";

/*const webstomp = {
  methods: {
    connect() {
      let client = Stomp.client( "wss://rabbitmq.vavt.ru:15673/ws")
      client.connect('webstomp', 'test',function (){
      })
    }
  }
}*/
//test
store.axios = axios

const app = createApp(
  App,
  {
    templatePath : document.querySelector('#app').dataset.templatePath
  })
  .use(VueAxios, axios)
  .use(router)
  .use(store)
  .use(BootstrapIconsPlugin)

app.config.globalProperties.$dayjs = dayjs

app.mount('#app')
