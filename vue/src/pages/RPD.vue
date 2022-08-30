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
    <Annotation/>
    <InformResources/>
    <div class="my-5">
      <h2 class="my-4" :id="unitTitles[9].code">9. {{ unitTitles[9].title }}</h2>
      <GradesCurrent/>
      <GradesCurrentDescription/>
      <GradesIntermediate/>
    </div>
    <PDFButton v-if="visible"/>
<!--    <NoticeWindow/>-->
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
import GradesIntermediate from "../components/RPD/Grades/GradesIntermediate";
import Technologies from "../components/RPD/EducationTechnologies";
import InformResources from "./../components/RPD/InformResources";
import Annotation from "@/components/RPD/Annotation";
//import NoticeWindow from "@/components/RPD/NoticeWindow";
import {mapState} from "vuex";

export default {
  name: "RPD",
  components: {
    Annotation,
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
    InformResources,
    GradesIntermediate
//    NoticeWindow
  },
  data() {
    return {
      ready: false,
      visible: this.$store.state.user?.role === 'admin' || process.env.NODE_ENV === 'development'
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
