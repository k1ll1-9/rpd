<template>
  <div class="my-5">
    <h3 class="my-4" :id="$store.state.rpd.static.unitTitles[2].code">2. {{ $store.state.rpd.static.unitTitles[2].title }}</h3>
    <div v-if="!isValid" class="error mb-4">Должны быть запролнены все поля</div>
    <VisualEditor :identity="['managed','disciplinePlace']"
                  @input="validate"
                  ref="place"/>
  </div>
</template>

<script>

import VisualEditor from "../UI/VisualEditor";
import required from "@/mixins/required";

export default {
  components: {VisualEditor},
  name: "Place",
  mixins: [required],
  data() {
    return {
      noticeData: {
        order: 2,
        id: this.$store.state.rpd.static.unitTitles[2].code,
        desc: 'Место дисциплины в структуре ОПОП'
      }}
  },
  mounted(){
    this.requiredFields = [
      this.$refs.place
    ]
    this.validate()
  }
}
</script>

<style scoped>

</style>
