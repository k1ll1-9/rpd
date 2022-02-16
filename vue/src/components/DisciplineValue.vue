<template>
  <div class="row">
    <h3 class="my-4"><strong>Объем дисциплины и виды учебной работы</strong></h3>
    <div class="col-8 mx-auto">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th class="col-6" rowspan="2">Вид учебной работы</th>
          <th class="col-1" rowspan="2">Всего часов</th>
          <th class="col-1" :colspan="semestersCount">Семестр</th>
        </tr>
        <tr>
          <th v-for="(index) in semestersCount" :key="index">{{ index }}</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td class="text-start ps-3">Аудиторные занятия (всего)</td>
          <td></td>
          <td v-for="(index) in semesters" :key="index"></td>
        </tr>
        <tr>
          <td class="text-start ps-3">Лекции</td>
          <td></td>
          <td v-for="(index) in semesters" :key="index"></td>
        </tr>
        <tr>
          <td class="text-start ps-3">Занятия семинарского типа</td>
          <td></td>
          <td v-for="(index) in semesters" :key="index"></td>
        </tr>
        <tr>
          <td class="text-start ps-3">Самостоятельная работа (всего)</td>
          <td></td>
          <td v-for="(index) in semesters" :key="index"></td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>


export default {
  components: {},
  data() {
    return {
      semesters: {
        "1": {
          "totalHours": 100,
          "totalUnits": 500
        },
        "2": {
          "totalHours": 50,
          "totalUnits": 200
        }
      }
    }
  },
  name: 'DisciplineValue',
  props: {},
  computed: {
    semestersCount() {
      return  Object.keys(this.semesters).length
    }
  },
  methods: {},
}
</script>

<style scoped>
h3 {
  margin: 40px 0 0;
}

ul {
  list-style-type: none;
  padding: 0;
}

li {
  display: inline-block;
  margin: 0 10px;
}

a {
  color: #42b983;
}

th {
  vertical-align: middle;
}

table {
  border: 2px;
}

</style>
