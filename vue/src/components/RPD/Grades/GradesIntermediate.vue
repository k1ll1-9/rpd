<template>
  <div class="my-5" id="intermediateControl">
    <h3>Промежуточная аттестация</h3>
    <div v-for="(types,semester) in controlTypes" :key="semester" class="my-4">
      <h3 class="my-3">{{ semester }} cеместр </h3>
      <div v-for="(type,index) in types.controlName" :key="index" class="my-4">
        <div class="my-3">
          <h4 class="my-3">{{ type }}</h4>
          <VisualEditor class="rte"
                        :ref="`semester_${semester}_type_${index}_${type}`"
                        @input="validate()"
                        :identity="['managed', 'intermediateControl', semester, index , type]"
                        :readonly="$store.state.rpd.locked"/>
        </div>
        <div class="my-3">
          <h4 class="my-3">Критерии оценки</h4>
          <VisualEditor class="rte"
                        :ref="`semester_${semester}_type_${index}_criterion`"
                        @input="validate()"
                        :identity="['managed', 'intermediateControl', semester, index , 'criterion']"
                        :readonly="$store.state.rpd.locked"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import VisualEditor from "../../UI/VisualEditor";
import {mapState} from "vuex";
import required from "../../../mixins/required";

export default {
  name: 'GradesIntermediate',
  components: {VisualEditor},
  mixins: [required],
  data() {
    return {
      requiredFields: [],
      noticeData: {
        order: 13,
        id: 'intermediateControl',
        desc: 'Промежуточная аттестация'
      }
    }
  },
  computed: {
    ...mapState({
      controlTypes: (state) => Object.fromEntries(Object.entries(state.rpd.static.disciplineValue.control.semesters)
          .map(([k, v]) => {

            const name = (Array.isArray(v.controlName)) ? v.controlName : [v.controlName]

            return [k, {controlName: name}]

          })
          .filter(([,v]) => v.controlName[0] !== undefined)

      ),
    })
  },
  methods: {
    checkRequired() {
      this.requiredFields = Object.entries(this.$refs)
          .filter(([k, v]) => {
            return k.includes('type') && v !== null
          })
          .map(([, v]) => v[0])
    }
  },
  updated() {
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
.rte {
  margin-bottom: 40px;
}
</style>
