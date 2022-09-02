<template>
  <div class="my-5">
    <h3 class="my-4" :id="$store.state.rpd.static.unitTitles[1].code">1. {{ $store.state.rpd.static.unitTitles[1].title }}</h3>
    <div class="my-4">
      <h4 class="my-4" :id="$store.state.rpd.static.unitTitles[1].subUnits[1].code">1.1 {{ $store.state.rpd.static.unitTitles[1].subUnits[1].title }}</h4>
      <VisualEditor :identity="['managed','disciplineTarget','target']"/>
    </div>
    <div class="my-4">
      <h4 class="my-4" :id="$store.state.rpd.static.unitTitles[1].subUnits[2].code">1.2 {{ $store.state.rpd.static.unitTitles[1].subUnits[2].title }}</h4>
      <VisualEditor :identity="['managed','disciplineTarget','task']"/>
    </div>
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
