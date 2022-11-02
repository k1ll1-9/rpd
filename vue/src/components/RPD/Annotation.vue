<template>
  <div class="my-5">
    <h3 class="my-4" :id="$store.state.rpd.static.unitTitles[7].code">7. {{ $store.state.rpd.static.unitTitles[7].title }}</h3>
    <VisualEditor
        ref="annotation"
        @input="validate()"
        :identity="['managed','annotation']"/>
  </div>
</template>

<script>

import VisualEditor from "../UI/VisualEditor";
import required from "../../mixins/required";

export default {
  components: {VisualEditor},
  mixins: [required],
  name: "Annotation",
  data() {
    return {
      requiredFields: [],
      noticeData: {
        order: 9,
        id: this.$store.state.rpd.static.unitTitles[7].code,
        desc: 'Аннотация рабочей программы дисциплины'
      }
    }
  },
  computed: {},
  mounted() {
    this.requiredFields = [
      this.$refs.annotation
    ]
    this.validate()
  }
}
</script>

<style scoped>

</style>
