<template>
  <div v-if="ready">
    <Navigation/>
    <EntryBlock/>
    <Authors/>
    <Target/>
    <Place/>
    <Competencies/>
    <div class="my-5">
      <h2 class="my-4" :id="unitTitles[4].code">4. {{
          unitTitles[4].title
        }}</h2>
      <DisciplineValue/>
      <DisciplineStructure/>
    </div>
    <div class="my-5">
      <h2 class="my-4" :id="unitTitles[5].code">5. {{
          unitTitles[5].title
        }}</h2>
      <ModulesThemes/>
      <ModulesSeminars/>
      <ModulesSRS/>
    </div>
    <Technologies/>
    <div class="my-5">
      <h2 class="my-4" :id="unitTitles[7].code">7. {{
          unitTitles[7].title
        }}</h2>
      <GradesCurrent/>
      <GradesCurrentDescription/>
    </div>
    <InformResources/>
    <PDFButton/>
  </div>
  <Preloader v-else style="margin-top: 200px"/>
</template>
<script>

import {mapActions,mapMutations,mapState} from "vuex";
import Authors from "./components/Units/Authors";
import Place from "./components/Units/Place";
import ModulesSeminars from "./components/Units/DisciplineModules/ModulesSeminars";
import ModulesThemes from "./components/Units/DisciplineModules/ModulesThemes.vue";
import DisciplineValue from './components/Units/DisciplineStructure/DisciplineValue.vue'
import DisciplineStructure from './components/Units/DisciplineStructure/DisciplineStructure.vue'
import EntryBlock from "./components/Units/EntryBlock";
import Target from "./components/Units/Target";
import Competencies from "./components/Units/Competencies";
import ModulesSRS from "./components/Units/DisciplineModules/ModulesSRS";
import Navigation from "./components/Units/Navigation";
import PDFButton from "./components/Units/PDFButton";
import Preloader from "./components/Misc/Preloader";
import GradesCurrent from "./components/Units/Grades/GradesCurrent"
import GradesCurrentDescription from "./components/Units/Grades/GradesCurrentDescription";
import Technologies from "./components/Units/Technologies";
import InformResources from "./components/Units/InformResources";

export default {
  name: 'App',
  components: {
    Technologies,
    Place,
    Preloader,
    PDFButton,
    Navigation,
    ModulesSeminars,
    ModulesSRS,
    EntryBlock,
    Target,
    Competencies,
    DisciplineValue,
    DisciplineStructure,
    ModulesThemes,
    GradesCurrent,
    GradesCurrentDescription,
    Authors,
    InformResources
  },
  props: {
    templatePath: String
  },
  data() {
    return {
      ready: false,
    }
  },
  computed: {
    ...mapState({
      unitTitles: state => state.rpd.static.unitTitles
    })
  },
  methods: {
    ...mapMutations({
      SET_API_URL: 'rpd/SET_API_URL',
      SET_PARAMS: 'rpd/SET_PARAMS'
    }),
    ...mapActions({
      initData: 'rpd/initData'
    })
  },
  async mounted() {
    const url = (process.env.NODE_ENV === 'development') ? process.env.VUE_APP_API_PROXY : `https://lk.vavt.ru/${this.templatePath}/api/index.php`

    await this.SET_API_URL(url)
    await this.SET_PARAMS()
    await this.initData()
    this.ready = true
  }
}
</script>

<style>
@font-face {
  font-family: "PT Sans";
  src: local("PT Sans"),
  url("./assets/fonts/PT-Sans/PTSans-Regular.ttf") format("truetype");
}

#app {
  margin-top: 60px;
  width: 1200px;
}

h3, h2 {
  font-weight: 600 !important;
  text-align: center;
}

* {
  font-family: 'PT Sans', sans-serif;
}

td, th {
  text-align: center;
}
</style>
