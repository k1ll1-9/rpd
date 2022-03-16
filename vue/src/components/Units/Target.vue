<template>
  <div class="my-5">
    <h3 class="my-4">1. Цель освоения дисциплины</h3>
    <VisualEditor :identity="['managed','disciplineTarget']"/>
  </div>
</template>

<script>

import VisualEditor from "../UI/VisualEditor";

export default {
  components: {VisualEditor},
  name: "Target",
  data() {
    return {}
  },
  computed: {}
}
</script>

<style scoped>

</style>
