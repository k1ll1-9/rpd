<template>
  <div>
    <EntryBlock :key="title" :title="title"/>
    <DisciplineValue/>
    <DisciplineStructure/>
  </div>
</template>
<script>

import DisciplineValue from './components/DisciplineValue.vue'
import DisciplineStructure from './components/DisciplineStructure.vue'
import EntryBlock from "./components/EntryBlock";

export default {
  name: 'App',
  components: {
    EntryBlock,
    DisciplineValue,
    DisciplineStructure
  },
  props: {
    templatePath: String
  },
  data() {
    return {
      testVal: 'test',
      title: '',
      data: null
    }
  },
  methods: {
/*    async saveFiled(e) {
      const res = await this.axios.post(this.APIurl,
          {
            action: "setData",
            data: e
          });

      console.log(res.data)
    },*/
  },
  mounted() {
    const url = (process.env.NODE_ENV === 'development') ? process.env.VUE_APP_API_PROXY : `https://lk.vavt.ru/${this.templatePath}/api/index.php`;
    this.$store.commit('SET_API_URL', url);
    this.$store.dispatch('GET_DATA');
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;

  margin-top: 60px;
  width: 1200px;
}

a:hover {
  color: #ffffff !important;
  text-decoration: none !important;
  background-color: transparent !important;
}
</style>
