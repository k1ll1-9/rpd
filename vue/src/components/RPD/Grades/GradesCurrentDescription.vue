<template>
  <div class="my-5"  id="gradesDescription">
    <h3>Оценочные средства текущего контроля успеваемости</h3>
    <div v-for="(discipline,index) in disciplines" :key="index" class="my-4">
      <h4 class="my-5">{{ discipline.title }}</h4>
      <template v-for="(control,i) in discipline.currentControl" :key="i">
        <h4 class="my-4">{{ control.title }}</h4>
        <VisualEditor class="rte"
                      :ref="`theme_${index}_description_${i}`"
                      @input="validate()"
                      :identity="['managed', 'disciplineStructure', index,'currentControl',i,'value']"
                      :readonly="$store.state.rpd.locked"/>
      </template>
    </div>
  </div>
</template>

<script>

import VisualEditor from "../../UI/VisualEditor";
import {mapState} from "vuex";
import required from "../../../mixins/required";

export default {
  name: 'GradesCurrentDescription',
  components: {VisualEditor},
  mixins: [required],
  data() {
    return {
      requiredFields: [],
      noticeData: {
        order: 12,
        id: 'gradesDescription',
        desc: 'Оценочные средства текущего контроля успеваемости'
      }
    }
  },
  computed: {
    ...mapState({
      disciplines: (state) => {
        return state.rpd.managed.disciplineStructure.map((el) => {
          const currentControl = el.currentControl.filter((subEl) => {
            return subEl.title?.trim() !== '' && subEl.title !== null
          })
          return {
            ...el,
            currentControl: currentControl
          }
        }).filter((el) => el.currentControl.length > 0)
      }
    })
  },
  methods: {
    checkRequired() {
      this.requiredFields = Object.entries(this.$refs)
          .filter(([k, v]) => {
            return k.includes('description') && v !== null
          })
          .map(([, v]) => v)
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
  margin-bottom: 80px;
}
</style>
