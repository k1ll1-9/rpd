<template>
  <div class="my-5">
    <h3>Промежуточная аттестация</h3>
    <div v-for="(types,semester) in controlTypes" :key="semester" class="my-4">
      <h3 class="my-3">{{ semester }} cеместр </h3>
      <div v-for="(type,index) in types.controlName" :key="index" class="my-4">
        <div class="my-3">
          <h4 class="my-3">{{ type }}</h4>
          <VisualEditor class="rte" :identity="['managed', 'intermediateControl', semester, index , type]"/>
        </div>
        <div class="my-3">
          <h4 class="my-3">Критерии оценки</h4>
          <VisualEditor class="rte" :identity="['managed', 'intermediateControl', semester, index , 'criterion']"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import VisualEditor from "../../UI/VisualEditor";
import {mapState} from "vuex";

export default {
  name: 'GradesIntermediate',
  components: {VisualEditor},
  computed:
      mapState({
        controlTypes: (state) => Object.fromEntries(Object.entries(state.rpd.static.disciplineValue.control.semesters).map(([k, v]) => {

              const name = (Array.isArray(v.controlName)) ? v.controlName : [v.controlName]

              return [k, {controlName: name}]

            })
        ),
      }),
  methods: {},
}
</script>

<style scoped>
.rte {
  margin-bottom: 40px;
}
</style>
