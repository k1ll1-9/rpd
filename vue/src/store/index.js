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

      console.log(res)

      state.static = res.data.static

      if (res.data.managed === null) {
        res.data.managed = {}
      }

      //TODO перенести на бэкенд
      for (const [semester, value] of Object.entries(state.static.disciplineStructure)) {
        value.load.forEach((load) => {
          if (load.classroom === 'Аудиторная') {
            if (!state.disciplineValue.classroom.semesters[semester]) {
              state.disciplineValue.classroom.semesters[semester] = {
                maxQuantity: 0
              }
            }
            state.disciplineValue.classroom.semesters[semester].maxQuantity += load.quantity
            state.disciplineValue.classroom.total += load.quantity
          }
          if (load.loadName === 'Лекции') {
            if (!state.disciplineValue.lectures.semesters[semester]) {
              state.disciplineValue.lectures.semesters[semester] = {
                maxQuantity: 0
              }
            }
            state.disciplineValue.lectures.semesters[semester].maxQuantity += load.quantity
            state.disciplineValue.lectures.total += load.quantity
          }
          if (load.loadName === 'СРС') {
            if (!state.disciplineValue.SRS.semesters[semester]) {
              state.disciplineValue.SRS.semesters[semester] = {
                maxQuantity: 0
              }
            }
            state.disciplineValue.SRS.semesters[semester].maxQuantity += load.quantity
            state.disciplineValue.SRS.total += load.quantity
          }
          if (load.loadName === 'Практические') {
            if (!state.disciplineValue.practice.semesters[semester]) {
              state.disciplineValue.practice.semesters[semester] = {
                maxQuantity: 0
              }
            }
            state.disciplineValue.practice.semesters[semester].maxQuantity += load.quantity
            state.disciplineValue.practice.total += load.quantity
          }
          if (!state.disciplineValue.sum.semesters[semester]) {
            state.disciplineValue.sum.semesters[semester] = {
              maxQuantity: 0
            }
          }
          state.disciplineValue.sum.semesters[semester].maxQuantity += load.quantity
          state.disciplineValue.sum.total += load.quantity
        })

        value.control.forEach((load) => {
          if (!state.disciplineValue.control.semesters[semester]) {
            state.disciplineValue.control.semesters[semester] = {
              controlName: load.loadName,
            }
          }
          if (!state.disciplineValue.controlSum.semesters[semester]) {
            state.disciplineValue.controlSum.semesters[semester] = {
              maxQuantity: load.ЗЕТ,
            }
          }
          state.disciplineValue.controlSum.total += load.ЗЕТ
        })
      }

      if (!res.data.managed.disciplineStructure) {
        state.managed.disciplineStructure = [
          {
            "title": '',
            "semester": res.data.static.disciplineStructure.length,
            "lectures": null,
            "practice": null,
            "SRS": null,
            "practicePrepare": null,
          }
        ]
      } else {
        state.managed.disciplineStructure = res.data.managed.disciplineStructure
      }

      if (!res.data.managed.competencies){

        state.competencies = res.data.static.competencies
        for (const item in state.competencies) {
          for (const indicators in state.competencies[item].nextLvl) {
            state.competencies[item].nextLvl[indicators].results = {
              know: [{
                value: ''
              }],
              can:  [{
                value: ''
              }],
              own:  [{
                value: ''
              }],
            }
          }

        }
      } else {
        state.competencies = res.data.managed.competencies
      }

      return true;
    },
    async updateData({commit, state}, payload) {
      commit('UPDATE_RPD_ITEM', payload)

      await this.axios.post(state.APIurl,
        {
          action: "setData",
          data: state.managed,
          params: state.params
        });
    }
  },


})
