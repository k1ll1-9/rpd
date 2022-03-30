import {createStore} from 'vuex'
import {rpd} from './modules/rpd'

export default createStore({
  modules: {
    rpd: rpd
  }
})
