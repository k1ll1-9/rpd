import {createStore} from 'vuex'

export default createStore({
  state: () => ({

  }),
  getters: {},
  mutations: {
    SET_API_URL(state,url){
      state.APIurl = url
    },
/*    UPDATE_STATE(state,payload){

    }*/
  },
  actions: {
    async GET_DATA({state}){
      const res = await this.axios.get(state.APIurl,
        {
          params: {
            action: "getData"
          }
        });

      state.disciplineStructure = res.data.disciplineStructure

      console.log(state.disciplineStructure)
    }
  },


})
