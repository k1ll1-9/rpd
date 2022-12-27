export const syllabuses = {
  state: () => ({

  }),
  mutations: {

  },
  actions: {
    async getStats({state, rootState}) {
      const res = await this.axios.get(rootState.APIurl,
        {
          params: {
            action: "getStatistics"
          }
        });

      state.stats = res.data

      return true
    }
  },
  namespaced : true
}
