import router from '@/router/router'

export const rpd = {
  state: () => ({
    managed: {}
  }),
  getters: {},
  mutations: {
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
    async initData({state, rootState}, params) {
      const res = await this.axios.get(rootState.APIurl,
        {
          params: {
            action: "getRPDData",
            params: params
          }
        });

      state.static = res.data.static
      state.managed = res.data.managed

      return true;
    },
    async updateData({commit, state, rootState}, payload) {
      commit(payload.updateType, payload)
      await this.axios.post(rootState.APIurl,
        {
          action: "setData",
          data: state.managed,
          params: router.currentRoute.value.query
        });
    },
/*    async pushState({state, rootState}) {
      await this.axios.post(rootState.APIurl,
        {
          action: "setData",
          data: state.managed,
          params: router.currentRoute.value.query
        });
    },*/
    async initPDF({state}) {
      const res = await this.axios.post('https://lk.vavt.ru/oplyuyko_test/printFormRPD.php',
        {
          action: "getPDF",
          data: state
        });
      return res.data.link;
    }
  },
  namespaced: true
}
