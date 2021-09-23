import { createApp } from 'vue'
import App from './App.vue'
import 'bootstrap/dist/css/bootstrap.min.css'
import 'jquery/src/jquery.js'
import 'bootstrap/dist/js/bootstrap.min.js'
import VueAxios from 'vue-axios'
import axios from 'axios'

createApp(App).use(VueAxios, axios).mount('#app')

