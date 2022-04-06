<template>
  <div class="my-5">
    <h3 class="my-4" :id="$store.state.rpd.static.unitTitles[6].code">6. {{ $store.state.rpd.static.unitTitles[6].title }}</h3>
    <VisualEditor :identity="['managed','educationTechnologies']"/>
  </div>
</template>

<script>

import VisualEditor from "../UI/VisualEditor";

export default {
  components: {VisualEditor},
  name: "Technologies",
  data() {
    return {}
  },
  computed: {}
}
</script>

<style scoped>

</style>
