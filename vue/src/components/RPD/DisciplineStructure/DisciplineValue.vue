<template>
  <div class="row">
    <h3 class="mb-5 mt-3">Объем дисциплины и виды учебной работы</h3>
    <div class="col-8 mx-auto">
      <table class="table table-bordered">
        <thead>
        <tr>
          <th class="col-5" rowspan="2">Вид учебной работы</th>
          <th class="col-1" rowspan="2">Всего часов</th>
          <th class="col-2" :colspan="$store.state.rpd.static.semestersCount">Семестр</th>
        </tr>
        <tr>
          <th v-for="(item,index) in $store.state.rpd.static.semesters" :key="index">
            {{ item }}
          </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(item,index) in disciplineValue" :key="{index}"
            :class="[{strong : item.label.strong},'align-middle']">
          <td class="text-start ps-3">{{ item.label.value }}</td>
          <td>{{ item.total || '' }}</td>
          <td v-for="(semester,number) in item.semesters" :key="number" v-html="tableData(index, semester)"></td>
        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>

import {mapState} from 'vuex'

export default {
  components: {},
  name: 'DisciplineValue',
  props: {},
  data() {
    return {
      order: {
        lectures: 0,
        practice: 1,
        classroom: 2,
        SRS: 3,
        overall: 4,
        control: 5,
        controlOverall: 6
      }
    }
  },
  computed:
      mapState({
        disciplineValue: function (state) {
          return Object.fromEntries(Object.entries(state.rpd.static.disciplineValue).map(([k, v]) => {
            return [k, {
              ...v,
              order: this.order[k]
            }]
          }).sort(([, a], [, b]) => a.order - b.order))
        }
      }),
  methods: {
    tableData(index, semester) {
      if (index === 'controlOverall' && Array.isArray(semester.quantity)) {
        return semester.quantity.join("+")
      }
      if (index === 'control') {
        return Array.isArray(semester.controlName) ? semester.controlName.join(", <br>") : semester.controlName
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

td {
  white-space: pre;
}
</style>
