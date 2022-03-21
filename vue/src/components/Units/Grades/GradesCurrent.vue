<template>
  <div class="my-5">
    <h3 class="my-5">7. Оценочные средства</h3>

    <table class="table-bordered w-100">
      <thead style="border-bottom: 1px #000000 solid">
      <tr>
        <th style="width: 10%">№ п/п</th>
        <th style="width: 25%">Наименование раздела дисциплины</th>
        <th style="width: 15%">Компетенция</th>
        <th style="width: 25%">Индикаторы достижения компетенции</th>
        <th style="width: 25%">Оценочные средства текущего контроля успеваемости</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(module,index) in competencies" :key="index">
        <td></td>
        <td></td>
        <td></td>
        <td><TextArea :identity="module.identity"/></td>
        <td></td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

import TextArea from "../../UI/TextArea";
import {mapState} from "vuex";

export default {
  name: 'Grades',
  components: {TextArea},
  computed:
      mapState({
        competencies: state => {
          //const indicators  = {}

          for (let competence in state.competencies){
            console.log(competence)
          }
/*            return {
              ...el,
              'identity': ['managed', 'disciplineStructure', i, 'SRSDescription'],
            }*/

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
