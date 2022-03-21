import {createStore} from 'vuex'

export default createStore({
  state: () => ({
    managed: {}
  }),
  getters: {},
  mutations: {
    SET_API_URL(state, url) {
      state.APIurl = url
    },
    SET_PARAMS(state) {
      const searchParams = new URLSearchParams(window.location.search)

      state.params = {
        profile: searchParams.get('profile'),
        special: searchParams.get('special'),
        year: searchParams.get('year'),
        name: searchParams.get('name')
      }
    },
    UPDATE_RPD_ITEM(state, payload) {
      payload.identity.reduce((acc, c, i, arr) => acc[c] = (arr.length === ++i) ? payload.value : acc[c] || {}, state)
    },
    PUSH_RPD_ITEM(state, payload) {
      const item = payload.identity.reduce((acc, c) => acc && acc[c], state)
      const newRow = Object.fromEntries(Object.entries(item[0]).map(([key, val]) => {
          val = null;
          return [key, val]
        })
      );
      item.push(newRow);
    },
    SPLICE_RPD_ITEM(state, payload) {
      payload.identity.reduce((acc, c) => acc && acc[c], state).splice(payload.index, 1)
    }
  },
  actions: {
    async initData({state}) {
      const res = await this.axios.get(state.APIurl,
        {
          params: {
            action: "getData",
            params: state.params
          }
        });

      state.static = res.data.static
      state.managed = res.data.managed

      return true;
    },
    async updateData({commit, state}, payload) {
      commit(payload.updateType, payload)

      await this.axios.post(state.APIurl,
        {
          action: "setData",
          data: state.managed,
          params: state.params
        });
    },
    async initPDF({state}){
      const res = await this.axios.post('https://lk.vavt.ru/oplyuyko_test/printFormRPD.php',
        {
          action: "getPDF",
          data: state
        });
      return res.data.link;
    }
  },
})
