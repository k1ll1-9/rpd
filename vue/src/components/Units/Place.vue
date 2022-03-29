<template>
  <div class="my-5">
    <h3 class="my-4" :id="$store.state.static.unitTitles[2].code">2. {{ $store.state.static.unitTitles[2].title }}</h3>
    <VisualEditor :identity="['managed','disciplinePlace']"/>
  </div>
</template>

<script>

import VisualEditor from "../UI/VisualEditor";

export default {
  components: {VisualEditor},
  name: "Place",
  data() {
    return {}
  },
  computed: {}
}
</script>

<style scoped>

</style>
