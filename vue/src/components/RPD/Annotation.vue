<template>
  <div class="my-5">
    <h3 class="my-4" :id="$store.state.rpd.static.unitTitles[7].code">7. {{ $store.state.rpd.static.unitTitles[7].title }}</h3>
    <VisualEditor :identity="['managed','annotation']"/>
  </div>
</template>

<script>

import VisualEditor from "../UI/VisualEditor";

export default {
  components: {VisualEditor},
  name: "Annotation",
  data() {
    return {}
  },
  computed: {}
}
</script>

<style scoped>

</style>
