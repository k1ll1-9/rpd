import {createApp} from 'vue'
import App from './App.vue'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'jquery/src/jquery.js'
import 'bootstrap/dist/js/bootstrap.min.js'
import VueAxios from 'vue-axios'
import axios from 'axios'
import VueSocketIO from 'vue-3-socket.io'
import SocketIO from 'socket.io-client'
import store from './store'

const mixins = {
  methods: {
    updateData(e) {
      console.log(e.target.value);
    }
  }
}

createApp(
  App,
  {
    templatePath : document.querySelector('#app').dataset.templatePath
  }).use(store).use(store)
  .mixin([mixins])
  .use(VueAxios, axios)
  .use(store)
  .use( new VueSocketIO({
    connection: SocketIO('http://172.16.10.107:3000'),
  }))
  .mount('#app')

