import {createStore} from 'vuex'
import {rpd} from './modules/rpd'

export default createStore({
  modules: {
    rpd: rpd
  },
  mutations: {},
  actions: {
    async init({state}) {

      state.APIurl = process.env.VUE_APP_API_PROXY

      const res = await this.axios.get(state.APIurl, {
        params: {
          action: "initApp"
        }
      })

      state.user = res.data.user
      console.log(state.user)
    }
  }
})
