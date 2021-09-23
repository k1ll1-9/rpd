<template>
  <h2>
    ГОСУДАРСТВЕННОЕ БЮДЖЕТНОЕ ОБРАЗОВАТЕЛЬНОЕ
    УЧРЕЖДЕНИЕ ВЫСШЕГО ОБРАЗОВАНИЯ
    «ВСЕРОССИЙСКАЯ АКАДЕМИЯ ВНЕШНЕЙ ТОРГОВЛИ
    МИНИСТЕРСТВА ЭКОНОМИЧЕСКОГО РАЗВИТИЯ РОССИЙСКОЙ ФЕДЕРАЦИИ»
  </h2>
  <h5 class="my-4">КОМПЕТЕНЦИИ ОБУЧАЮЩЕГОСЯ, ФОРМИРУЕМЫЕ В РЕЗУЛЬТАТЕ ОСВОЕНИЯ ДИСЦИПЛИНЫ (МОДУЛЯ)</h5>
  <table class="table">
    <thead style="border-bottom: 1px #000000 solid">
    <tr>
      <th scope="col" rowspan="2" style="vertical-align: middle">Код компетенции</th>
      <th scope="col" colspan="3">Планируемые результаты освоения дисциплины (модуля)</th>
    </tr>
    <tr>
      <th scope="col">Знать (1)</th>
      <th scope="col">Уметь (2)</th>
      <th scope="col">Владеть (3)</th>
    </tr>
    </thead>
    <tbody>
    <TableRow :row="key" v-for="key in rows" :key="key"/>
    </tbody>
  </table>

</template>
<script>

import TableRow from './components/TableRow.vue'

export default {
  name: 'App',
  components: {
    TableRow
  },
  data() {
    return {
      rows: 12
    }
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;

  margin-top: 60px;
  width: 1200px;
}

a:hover {
  color: #ffffff !important;
  text-decoration: none !important;
  background-color: transparent !important;
}
</style>
