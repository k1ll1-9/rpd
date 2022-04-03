<template>
  <div class="my-5">
    <h3 class="my-4" :id="unitTitles[5].subUnits[2].code">
      5.2 {{ unitTitles[5].subUnits[2].title }}
    </h3>
    <div v-for="(modules,title,index) in seminars" :key="index" class="my-4">
      <h3>Тема {{ title }}</h3>
      <div v-for="(semester,number) in modules" :key="number" class="my-4">
        <h3>Семестр {{ number }}</h3>
        <div v-for="(seminarIndex) in semester.count" :key="seminarIndex" class="my-5">
          <h4 class="my-5">Семинар {{ seminarIndex }}</h4>
          <VisualEditor class="my-5" :identity="[...semester.identity, seminarIndex]"/>
        </div>
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
        ...mapState({
          unitTitles: state => state.rpd.static.unitTitles
        }),
        seminars: state => {
          const seminars = {}

          state.rpd.managed.disciplineStructure.forEach((el, i) => {

            if (el.title === null || el.load?.seminars === undefined) {
              return;
            }

            if (seminars[el.title] === undefined) {
              seminars[el.title] = {};
            }

            if (el.semester !== null) {
              seminars[el.title][el.semester] = {
                'seminars': el.seminars || [],
                'count': Math.ceil(el.load?.seminars / 2),
                'identity': ['managed', 'disciplineStructure', i, 'seminars']
              }
            }

          })
          return seminars
        },
      }),
  methods: {

  },
}
</script>

<style scoped>

</style>
