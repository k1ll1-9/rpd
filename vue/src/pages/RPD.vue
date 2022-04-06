<template>
  <div v-if="ready">
    <Navigation/>
    <EntryBlock/>
    <Authors/>
    <Target/>
    <Place/>
    <Competencies/>
    <div class="my-5">
      <h2 class="my-4" :id="unitTitles[4].code">4. {{ unitTitles[4].title }}</h2>
      <DisciplineValue/>
      <DisciplineStructure/>
    </div>
    <div class="my-5">
      <h2 class="my-4" :id="unitTitles[5].code">5. {{ unitTitles[5].title }}</h2>
      <ModulesThemes/>
      <ModulesSeminars/>
      <ModulesSRS/>
    </div>
    <Technologies/>
    <div class="my-5">
      <h2 class="my-4" :id="unitTitles[7].code">7. {{ unitTitles[7].title }}</h2>
      <GradesCurrent/>
      <GradesCurrentDescription/>
    </div>
    <InformResources/>
    <PDFButton/>
  </div>
  <Preloader v-else style="margin-top: 200px"/>
</template>

<script>
import Authors from "./../components/RPD/Authors";
import Place from "./../components/RPD/Place";
import ModulesSeminars from "./../components/RPD/DisciplineModules/ModulesSeminars";
import ModulesThemes from "./../components/RPD/DisciplineModules/ModulesThemes.vue";
import DisciplineValue from './../components/RPD/DisciplineStructure/DisciplineValue.vue'
import DisciplineStructure from './../components/RPD/DisciplineStructure/DisciplineStructure.vue'
import EntryBlock from "./../components/RPD/EntryBlock";
import Target from "./../components/RPD/Target";
import Competencies from "./../components/RPD/Competencies";
import ModulesSRS from "./../components/RPD/DisciplineModules/ModulesSRS";
import Navigation from "./../components/RPD/Navigation";
import PDFButton from "./../components/RPD/PDFButton";
import Preloader from "./../components/Misc/Preloader";
import GradesCurrent from "./../components/RPD/Grades/GradesCurrent"
import GradesCurrentDescription from "./../components/RPD/Grades/GradesCurrentDescription";
import Technologies from "../components/RPD/EducationTechnologies";
import InformResources from "./../components/RPD/InformResources";
import {mapState} from "vuex";

export default {
  name: "RPD",
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
  async mounted() {
    this.ready = await this.$store.dispatch('rpd/initData', this.$route.query);
  }
}
</script>

<style scoped>

</style>
