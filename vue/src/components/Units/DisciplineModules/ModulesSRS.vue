<template>
  <div class="my-5">
    <h3 class="my-5">5.3. Программа самостоятельной работы студентов </h3>

    <table class="table-bordered w-100">
      <thead style="border-bottom: 1px #000000 solid">
      <tr>
        <th>№ п/п</th>
        <th style="width: 30%">Наименование раздела дисциплины</th>
        <th style="width: 10%">Семестр</th>
        <th style="width: 40%">Вид самостоятельной работы</th>
        <th style="width: 10%">Трудоемкость <br>(в акад. часах)</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(module,index) in SRS" :key="index">
        <td>{{ index + 1 }}</td>
        <td>{{ module.title }}</td>
        <td>{{ module.semester }}</td>
        <td><TextArea :identity="module.identity"/></td>
        <td>{{ module.load.SRS }}</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

import TextArea from "../../UI/TextArea";
import {mapState} from "vuex";

export default {
  name: 'ModulesSRS',
  components: {TextArea},
  computed:
      mapState({
        SRS: state => {
          return state.managed.disciplineStructure.map((el, i) => {
            return {
              ...el,
              'identity': ['managed', 'disciplineStructure', i, 'SRSDescription'],
            }
          }).filter((el) => el.load?.SRS && el.load?.SRS !== 0)
        }
      }),
  methods: {},
}
</script>

<style scoped>
th {
  vertical-align: middle;
  padding: 10px;
}
</style>
