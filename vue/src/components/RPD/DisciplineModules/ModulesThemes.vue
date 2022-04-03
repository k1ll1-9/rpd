<template>
  <div class="my-3">
    <h3 class="my-4" :id="unitTitles[5].subUnits[1].code">
      5.1 {{ unitTitles[5].subUnits[1].title }}
    </h3>
    <div v-for="(module,title,index) in modules" :key="title" class="my-4">
      <h3 class="my-4">Тема {{index +1 }}. {{ title }}</h3>
      <template v-if="module !== null">
        <div v-for="(semester,index) in module" :key="index" class="my-4">
          <h4 class="my-4">Семестр {{ index }}</h4>
          <VisualEditor class="my-5" :identity="semester.identity"/>
        </div>
      </template>
    </div>
  </div>
</template>

<script>

import VisualEditor from "../../UI/VisualEditor";
import {mapState} from "vuex";

export default {
  components: {VisualEditor},
  name: 'ModulesThemes',
  computed:
      mapState({
        ...mapState({
          unitTitles: state => state.rpd.static.unitTitles
        }),
        modules: state => {
          const modules = {}

          state.rpd.managed.disciplineStructure.forEach((el, i) => {

            if (el.title === null) {
              return;
            }

            if (modules[el.title] === undefined) {
              modules[el.title] = {};
            }

            if (el.semester !== null) {
              modules[el.title][el.semester] = {
                'theme': el.theme,
                'identity': ['managed','disciplineStructure', i, 'theme']
              }
            }

          })

          return modules
        }
      }),
  methods: {
  },
  mounted() {
  }
}
</script>

<style scoped>

</style>
