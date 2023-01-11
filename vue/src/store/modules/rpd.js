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
    },
    ADD_ERROR(state, payload) {
      state.errors = state.errors || []

      if (state.errors.filter((el) => el.id === payload.id).length === 0) {
        state.errors.push(payload)
      }
    },
    REMOVE_ERROR(state, payload) {
      state.errors = state.errors || []
      state.errors = state.errors.filter((el) => el.id !== payload.id)
    },
    UNLOCK_RPD(state) {
      state.locked = false
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
      state.managed = res.data.managed || {}
      state.status = res.data.status
      state.locked = res.data.locked

      //создаем копии сложных объектов из шаблонов, если они еще не заполнены
      if (state.managed.competencies === undefined) {
        state.managed.competencies = JSON.parse(JSON.stringify(state.static.competencies));
      }
      if (state.managed.disciplineStructure === undefined) {
        state.managed.disciplineStructure = JSON.parse(JSON.stringify(state.static.disciplineStructure));
      }
      if (state.managed.informationalResources === undefined) {
        state.managed.informationalResources = JSON.parse(JSON.stringify(state.static.informationalResources));
      }

      return true
    },
    async updateData({commit, state, rootState}, payload) {
      commit(payload.updateType, payload)

      const data = {
        action: "setData",
        data: state.managed,
        params: router.currentRoute.value.query
      }

      if (state.status === 'blank') {
        data.status = 'progress'
      }

      await this.axios.post(rootState.APIurl, data);
    },
    async initPDF({state},type) {
      const res = await this.axios.post(process.env.VUE_APP_PDF_URL,
        {
          data: {
            ...state,
            PDFType: type
          }
        });
      return res.data.link
    },
    async setStatus({rootState}, payload) {

      const data = {
        action: "setStatus",
        status: payload.status,
        statusName: payload.statusName,
        params: router.currentRoute.value.query
      }

      const res = await this.axios.post(rootState.APIurl, data);

      return res.data
    },
  },
  namespaced: true
}
