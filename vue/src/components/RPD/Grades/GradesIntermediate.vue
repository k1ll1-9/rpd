<template>
  <div class="my-5">
    <h3>Критерии оценки промежуточной аттестации</h3>
    <div v-for="(types,semester) in controlTypes" :key="semester" class="my-4">
      <h3 class="my-3">{{ semester }} cеместр </h3>
      <div v-for="(type,index) in types.controlName" :key="index" class="my-4">
        <h3 class="my-3">{{ type }}</h3>
        <VisualEditor class="rte" :identity="['managed', 'intermediateControl', semester,type]"/>
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
              let name

              if (Array.isArray(v.controlName)) {
                name = v.controlName
              } else {
                name = [v.controlName]
              }

              return [k, { controlName : name}]

            })
        ),
      }),
  methods: {},
}
</script>

<style scoped>
.rte {
  margin-bottom: 80px;
}
</style>
