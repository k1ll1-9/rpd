<template>
  <h2>
    ГОСУДАРСТВЕННОЕ БЮДЖЕТНОЕ ОБРАЗОВАТЕЛЬНОЕ
    УЧРЕЖДЕНИЕ ВЫСШЕГО ОБРАЗОВАНИЯ
    «ВСЕРОССИЙСКАЯ АКАДЕМИЯ ВНЕШНЕЙ ТОРГОВЛИ
    МИНИСТЕРСТВА ЭКОНОМИЧЕСКОГО РАЗВИТИЯ РОССИЙСКОЙ ФЕДЕРАЦИИ»
  </h2>
  <h3>
    <b>Рабочая программа учебной дисциплины</b>
  </h3>
  <h2>
    <b>"{{ $store.state.static.name.toUpperCase() }}"</b>
  </h2>
  <h4>{{ $store.state.static.syllabusData.special_code }} "{{ $store.state.static.syllabusData.special }}"</h4>
  <h4>Профиль - "{{ $store.state.static.syllabusData.profile }}"</h4>
  <h4>Год набора - {{ yearOfEntrance }}</h4>
</template>

<script>
export default {
  name: "EntryBlock",
  data(){
    return {
      yearOfEntrance: new Date(this.$store.state.static.syllabusData.year).getFullYear()
    }
  },
  computed: {

  }
}
</script>

<style scoped>
h2 {
  margin: 50px 0;
}
</style>
