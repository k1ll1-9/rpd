<template>
  <div v-if="ready">
    <EntryBlock/>
    <Competencies/>
    <DisciplineValue/>
    <DisciplineStructure/>
  </div>
</template>
<script>

import DisciplineValue from './components/Units/DisciplineValue.vue'
import DisciplineStructure from './components/Units/DisciplineStructure.vue'
import EntryBlock from "./components/Units/EntryBlock";
import Competencies from "./components/Units/Competencies";

export default {
  name: 'App',
  components: {
    EntryBlock,
    Competencies,
    DisciplineValue,
    DisciplineStructure
  },
  props: {
    templatePath: String
  },
  data() {
    return {
      ready: false
    }
  },
  methods: {},
  async mounted() {
    const url = (process.env.NODE_ENV === 'development') ? process.env.VUE_APP_API_PROXY : `https://lk.vavt.ru/${this.templatePath}/api/index.php`;

    await this.$store.commit('SET_API_URL', url);
    await this.$store.commit('SET_PARAMS');
    this.ready = await this.$store.dispatch('initData');
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
