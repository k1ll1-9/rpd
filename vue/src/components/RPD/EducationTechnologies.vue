<template>
  <div class="my-5">
    <h3 class="my-4" :id="$store.state.rpd.static.unitTitles[6].code">6. {{ $store.state.rpd.static.unitTitles[6].title }}</h3>
    <VisualEditor
        ref="technologies"
        @input="validate()"
        :identity="['managed','educationTechnologies']"
        :readonly="$store.state.rpd.locked"/>
  </div>
</template>

<script>

import VisualEditor from "../UI/VisualEditor";
import required from "../../mixins/required";

export default {
  components: {VisualEditor},
  mixins: [required],
  name: "Technologies",
  data() {
    return {
      requiredFields: [],
      noticeData: {
        order: 8,
        id: this.$store.state.rpd.static.unitTitles[6].code,
        desc: 'Образовательные технологии'
      }
    }
  },
  computed: {},
  mounted() {
    this.requiredFields = [
      this.$refs.technologies
    ]
    this.validate()
  }
}
</script>

<style scoped>

</style>
