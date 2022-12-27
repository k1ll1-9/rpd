<template>
  <div v-if="seminars" class="my-5">
    <h3 class="my-4" :id="unitTitles[5].subUnits[2].code">
      5.2 {{ unitTitles[5].subUnits[2].title }}
    </h3>
    <div v-for="(semester,index) in seminars" :key="index" class="my-4">
      <h3 v-if="count(seminars) > 1">Семестр {{ index }}</h3>
      <div v-for="(theme,number) in semester" :key="number" class="my-4">
        <h3>Тема {{ number }} . {{ theme.title }} </h3>
        <div v-for="(seminarIndex) in theme.count" :key="seminarIndex" class="my-5">
          <h4 class="my-5">Семинар {{ seminarIndex }}</h4>
          <VisualEditor
              :ref="`semester_${index}_theme_${number}_seminar_${seminarIndex}`"
              @input="validate()"
              class="my-5"
              :identity="[...theme.identity, seminarIndex]"
              :readonly="$store.state.rpd.locked"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import VisualEditor from "../../UI/VisualEditor";
import {mapState} from "vuex";
import required from "@/mixins/required";

export default {
  components: {VisualEditor},
  mixins: [required],
  name: 'ModulesSeminars',
  data() {
    return {
      requiredFields: [],
      noticeData: {
        order: 6,
        id: this.$store.state.rpd.static.unitTitles[5].subUnits[2].code,
        desc: 'Планы семинарских / практических занятий'
      }
    }
  },
  computed: {
    ...mapState({
      unitTitles: state => state.rpd.static.unitTitles,
      seminars: state => {
        const seminars = {}

        state.rpd.managed.disciplineStructure.forEach((el, i) => {

          if (el.title === null || el.load?.seminars === undefined || el.semester === null) {
            return;
          }

          const count = Math.ceil(el.load?.seminars / 2) || 0

          if (count !== 0) {

            if (seminars[el.semester] === undefined) {
              seminars[el.semester] = {};
            }

            seminars[el.semester][i + 1] = {
              'title': el.title,
              'seminars': el.seminars || [],
              'count': Math.ceil(el.load?.seminars / 2) || 0,
              'identity': ['managed', 'disciplineStructure', i, 'seminars'],
            }
          }

        })

        return (Object.keys(seminars).length !== 0) ? seminars : false
      },
    }),
  },
  methods: {
    count($module) {
      return Object.keys($module).length
    },
    checkRequired() {
      this.requiredFields = Object.entries(this.$refs)
          .filter(([k, v]) => {  return  k.includes('seminar') && v !== null})
          .map(([, v]) => v[0])
    }
  },
  updated(){
    this.checkRequired()
    this.validate()
  },
  mounted() {
    this.checkRequired()
    this.validate()
  }
}
</script>

<style scoped>

</style>
