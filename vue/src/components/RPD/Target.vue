<template>
  <div class="my-5">
    <h3 class="my-4" :id="$store.state.rpd.static.unitTitles[1].code">1. {{ $store.state.rpd.static.unitTitles[1].title }}</h3>
    <span v-if="!isValid" class="error">Должны быть заполнены все поля</span>
    <div class="my-4">
      <h4 class="my-4" :id="$store.state.rpd.static.unitTitles[1].subUnits[1].code">1.1 {{ $store.state.rpd.static.unitTitles[1].subUnits[1].title }}</h4>
      <VisualEditor :identity="['managed','disciplineTarget','target']"
                    @input="validate"
                    ref="target"
                    :readonly="$store.state.rpd.locked"/>
    </div>
    <div class="my-4">
      <h4 class="my-4" :id="$store.state.rpd.static.unitTitles[1].subUnits[2].code">1.2 {{ $store.state.rpd.static.unitTitles[1].subUnits[2].title }}</h4>
      <VisualEditor :identity="['managed','disciplineTarget','task']"
                    @input="validate"
                    ref="task"
                    :readonly="$store.state.rpd.locked"/>
    </div>
  </div>
</template>

<script>

import VisualEditor from "../UI/VisualEditor";
import required from "@/mixins/required";

export default {
  components: {VisualEditor},
  mixins: [required],
  name: "Target",
  data() {
    return {
      requiredFields: [],
      noticeData: {
        order: 1,
        id: this.$store.state.rpd.static.unitTitles[1].code,
        desc: 'Цели и задачи освоения дисциплины'
      }
    }
  },
  computed: {},
  mounted(){
    this.requiredFields = [
      this.$refs.target,
      this.$refs.task
    ]
    this.validate()
  }
}
</script>

<style scoped>

</style>
