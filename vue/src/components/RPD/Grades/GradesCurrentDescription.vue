<template>
  <div class="my-5">
    <h3>Оценочные средства текущего контроля успеваемости</h3>
    <div v-for="(discipline,index) in disciplines" :key="index" class="my-4">
      <h4 class="my-5">{{ discipline.title }}</h4>
      <template v-for="(control,i) in discipline.currentControl" :key="i">
        <h4 class="my-4">{{ control.title }}</h4>
        <VisualEditor class="rte" :identity="['managed', 'disciplineStructure', index,'currentControl',i,'value']"/>
      </template>
    </div>
  </div>
</template>

<script>

import VisualEditor from "../../UI/VisualEditor";
import {mapState} from "vuex";

export default {
  name: 'GradesCurrentDescription',
  components: {VisualEditor},
  computed:
      mapState({
        disciplines: (state) => {
          return state.rpd.managed.disciplineStructure.map((el) => {
            const currentControl = el.currentControl.filter((subEl) => {
              return subEl.title?.trim() !== '' && subEl.title !== null
            })
            return {
              ...el,
              currentControl : currentControl
            }
          }).filter((el) => el.currentControl.length > 0)
        }
      }),
  methods: {},
}
</script>

<style scoped>
.rte {
  margin-bottom: 80px;
}
</style>
