import {createApp} from 'vue'
import App from './App.vue'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'jquery/src/jquery.js'
import 'bootstrap/dist/js/bootstrap.min.js'
import VueAxios from 'vue-axios'
import axios from 'axios'
import store from './store'
//import SockJS from "sockjs-client";
import Stomp from "webstomp-client";

const mixins = {
  methods: {
    updateData(e) {
      console.log(e.target.value);
    }
  }
}

const webstomp = {
  methods: {
    connect() {
      let client = Stomp.client( "wss://rabbitmq.vavt.ru:15673/ws")
      client.connect('webstomp', 'test',function (){
      })
    }
  }
}

createApp(
  App,
  {
    templatePath : document.querySelector('#app').dataset.templatePath
  })
  .mixin(webstomp)
  .mixin(mixins)
  .use(VueAxios, axios)
  .use(store)
  .mount('#app')

