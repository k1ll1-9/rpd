import {createStore} from 'vuex'
import {rpd} from './modules/rpd'

export default createStore({
  modules: {
    rpd: rpd
  },
  mutations: {
    SET_API_URL(state, url) {
      state.APIurl = url
    }
  }
})
