<template>
  <div class="my-3">
    <h3 class="my-4" :id="unitTitles[5].subUnits[1].code">
      5.1 {{ unitTitles[5].subUnits[1].title }}
    </h3>
    <div v-for="(semester,index) in modules" :key="index" class="my-4">
      <h3 class="my-4" v-if="count(modules) >1">Семестр {{ index }}</h3>
      <template v-if="semester !== null">
        <div v-for="(theme,index) in semester" :key="index" class="my-4">
          <h4 class="my-4">Тема {{ index }}. {{ theme.title }}</h4>
          <VisualEditor class="my-5" :identity="theme.identity"/>
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

          const modules = {};

          state.rpd.managed.disciplineStructure.forEach((el, i) => {

            if (el.title === null || el.semester === null) {
              return;
            }

            if (modules[el.semester] === undefined) {
              modules[el.semester] = {};
            }

            modules[el.semester][i + 1] = {
              'title': el.title,
              'identity': ['managed', 'disciplineStructure', i, 'theme']
            }
          })
          return modules;
        }
      }),
  methods: {
    count($module) {
      return Object.keys($module).length
    }
  },
}
</script>

<style scoped>

</style>
