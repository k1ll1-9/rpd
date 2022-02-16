<template>
  <div>
    <h3 class="my-4"><strong>Структура и содержание дисциплины (модуля)</strong></h3>
    <h1>{{ }}</h1>
    <div class="row">
      <div class="col">
        <table class="table-bordered">
          <thead style="border-bottom: 1px #000000 solid">
          <tr>
            <th class="col-1" rowspan="2">№ п/п</th>
            <th class="col-5" rowspan="2">Наименование раздела дисциплины</th>
            <th class="col-1" rowspan="2">Семестр</th>
            <th class="col-4" colspan="3">Вид учебной работы <br> (в академических часах)</th>
            <th class="col-2" rowspan="2">В том числе в форме практической подготовки</th>
          </tr>
          <tr>
            <th>Л</th>
            <th>С/ПЗ</th>
            <th>СР</th>
          </tr>
          </thead>
          <tbody>
          <tr v-for="(discipline,index) in disciplineStructure" :key="index">
            <td>
              {{ index + 1 }}
            </td>
            <td v-for="(value,name) in discipline" :key="name">
                <Input :identity="['disciplineStructure',index,name,value]" />
            </td>
          </tr>
          </tbody>
        </table>
        <div>
          <button type="button" @click="addRow" class="btn btn-primary mt-4">Добавить строку</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import {mapState} from 'vuex'
import Input from "./Input";

export default {
  components: {Input},
  name: 'DisciplineStructure',
  props: {},
  computed: mapState({
    disciplineStructure: state => state.disciplineStructure,
  }),
  methods: {
    updateField(e) {
      this.$emit('updateField', {
        discStructure: e
      });
    },
    addRow() {
      const newRow = Object.fromEntries(Object.entries(this.disciplineStructure[0]).map(([key, val]) => {
            val = null;
            return [key, val]
          })
      );

      this.disciplineStructure.push(newRow);
    }
  },
  mounted() {

  }
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

</style>
