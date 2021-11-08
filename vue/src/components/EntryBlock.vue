<template>
  <h2>
    ГОСУДАРСТВЕННОЕ БЮДЖЕТНОЕ ОБРАЗОВАТЕЛЬНОЕ
    УЧРЕЖДЕНИЕ ВЫСШЕГО ОБРАЗОВАНИЯ
    «ВСЕРОССИЙСКАЯ АКАДЕМИЯ ВНЕШНЕЙ ТОРГОВЛИ
    МИНИСТЕРСТВА ЭКОНОМИЧЕСКОГО РАЗВИТИЯ РОССИЙСКОЙ ФЕДЕРАЦИИ»
  </h2>
  <h3>
    {{ $store.state.rpdData.title }}
  </h3>
</template>

<script>
export default {
  name: "EntryBlock",
  props: {
    title: String
  }
}
</script>

<style scoped>
h2 {
  margin: 50px 0;
}
</style>
