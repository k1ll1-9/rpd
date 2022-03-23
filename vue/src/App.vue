<template>
  <div v-if="ready">
    <Navigation/>
    <EntryBlock/>
    <Target/>
    <Competencies/>
    <div class="my-5">
      <h2 class="my-4" :id="$store.state.static.unitTitles[4].code">4. {{ $store.state.static.unitTitles[4].title }}</h2>
      <DisciplineValue/>
      <DisciplineStructure/>
    </div>
    <div class="my-5">
      <h2 class="my-4" :id="$store.state.static.unitTitles[5].code">5. {{ $store.state.static.unitTitles[5].title }}</h2>
      <ModulesThemes/>
      <ModulesSeminars/>
      <ModulesSRS/>
    </div>
    <!--    <GradesCurrent/>-->
    <button v-if="!PDFLink" class="btn btn-lg btn-primary mb-4" @click="getPDF()">
      Сгенерировать PDF
    </button>
    <a v-else :href="PDFLink" class="btn btn-success btn-lg mb-4" target="_blank">Перейти к PDF</a>
  </div>
</template>
<script>

import ModulesSeminars from "./components/Units/DisciplineModules/ModulesSeminars";
import ModulesThemes from "./components/Units/DisciplineModules/ModulesThemes.vue";
import DisciplineValue from './components/Units/DisciplineStructure/DisciplineValue.vue'
import DisciplineStructure from './components/Units/DisciplineStructure/DisciplineStructure.vue'
import EntryBlock from "./components/Units/EntryBlock";
import Target from "./components/Units/Target";
import Competencies from "./components/Units/Competencies";
import ModulesSRS from "./components/Units/DisciplineModules/ModulesSRS";
import Navigation from "./components/Units/Navigation";
//import GradesCurrent from "./components/Units/Grades/GradesCurrent"

export default {
  name: 'App',
  components: {
    Navigation,
    ModulesSeminars,
    ModulesSRS,
    EntryBlock,
    Target,
    Competencies,
    DisciplineValue,
    DisciplineStructure,
    ModulesThemes,
//    GradesCurrent
  },
  props: {
    templatePath: String
  },
  data() {
    return {
      ready: false,
      PDFLink: ''
    }
  },
  methods: {
    async getPDF() {
      this.PDFLink = await this.$store.dispatch('initPDF')
    }
  },
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
  text-decoration: underline;
}

a {
  color: #000000 !important;
}

h3,h2 {
  font-weight: 600 !important;
}
*{
  font-family: 'PT Sans', sans-serif;
}
</style>
