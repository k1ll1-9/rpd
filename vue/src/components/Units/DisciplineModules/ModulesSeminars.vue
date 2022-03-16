<template>
  <div class="my-5">
    <h3>5.2 Планы семинарских / практических занятий (если предусмотрены учебным планом)</h3>
    <div v-for="(seminar,index) in seminars" :key="index" class="my-4">
      <div class="my-5">
      <h4 class="my-5">Семинар {{ index + 1 }}. {{seminar.title}}</h4>
      <VisualEditor class="my-5" :identity="seminar.identity"/>
      </div>
    </div>
  </div>
</template>

<script>

import VisualEditor from "../../UI/VisualEditor";
import {mapState} from "vuex";

export default {
  components: {VisualEditor},
  name: 'ModulesSeminars',
  computed:
      mapState({
        seminars: state => {
          return state.managed.disciplineStructure.map((el, i) => {
            return {
              ...el,
              'identity': ['managed', 'disciplineStructure', i, 'seminarsDescription'],
            }
          }).filter((el) => el.load?.seminars && el.load?.seminars !== 0)
        }
      }),
  methods: {},
}
</script>

<style scoped>

</style>
