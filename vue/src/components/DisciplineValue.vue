<template>
  <div class="row">
    <h3 class="my-4"><strong>Объем дисциплины и виды учебной работы</strong></h3>
    <div class="col-8 mx-auto">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th class="col-5" rowspan="2">Вид учебной работы</th>
          <th class="col-1" rowspan="2">Всего часов</th>
          <th class="col-2" :colspan="semestersCount">Семестр</th>
        </tr>
        <tr>
          <th v-for="index in semestersCount" :key="index">
            {{ index }}
          </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item,index) in $store.state.static.disciplineValue" :key="{index}"
            :class="{strong : item.label.strong}">
          <td class="text-start ps-3">{{ item.label.value }}</td>
          <td>{{ item.total || '' }}</td>
          <td v-for="(semester,number) in item.semesters" :key="number">
            {{ tableData(index, semester) }}
          </td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>

export default {
  components: {},
  name: 'DisciplineValue',
  props: {},
  computed: {
    semestersCount() {
      return Object.keys(this.$store.state.static.disciplineStructure).length
    },
  },
  methods: {
    tableData(index, semester) {
      console.log(semester)
      if (index === 'control') {
        return semester.controlName
      } else {
        return semester.quantity || ''
      }
    }
  },
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

.strong {
  font-weight: 600;
}

table {
  border: 2px;
}

</style>
