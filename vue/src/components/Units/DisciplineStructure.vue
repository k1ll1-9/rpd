<template>
  <div>
    <h3 class="my-4">Структура и содержание дисциплины (модуля)</h3>
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
            <th class="col-1" rowspan="2"></th>
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
            <td>
              <TextInput :identity="['managed','disciplineStructure',index,'title']"/>
            </td>
            <td>
              <TextInput :identity="['managed','disciplineStructure',index,'semester']"/>
            </td>
            <td>
              <DigitInput class='text-center'
                          :identity="['managed','disciplineStructure',index,'lectures']"/>
            </td>
            <td>
              <DigitInput class='text-center'
                          :identity="['managed','disciplineStructure',index,'practice']"/>
            </td>
            <td>
              <DigitInput class='text-center'
                          :identity="['managed','disciplineStructure',index,'SRS']"/>
            </td>
            <td>
              <DigitInput class='text-center'
                          :identity="['managed','disciplineStructure',index,'practicePrepare']"/>
            </td>
            <td style="min-width: 62px">
              <button type="button" v-show="disciplineStructure.length > 1"
                      @click="removeRow(index)"
                      class="btn btn-danger px-3 ">
                <BIconX-octagon class="cross"/>
              </button>
            </td>
          </tr>
          </tbody>
        </table>
        <div>
          <button type="button"
                  @click="addRow"
                  class="btn btn-primary mt-4">
            Добавить строку
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import {mapState} from 'vuex'
import TextInput from "../UI/TextInput";
import DigitInput from "../UI/DigitInput";

export default {
  components: {TextInput, DigitInput},
  name: 'DisciplineStructure',
  props: {},
  computed:
      mapState({
        disciplineStructure: state => state.managed.disciplineStructure,
      }),
  methods: {
    addRow() {
      this.$store.dispatch('updateData', {identity: ['managed', 'disciplineStructure'], updateType: 'PUSH_RPD_ITEM'})
    },
    removeRow(index) {
      this.$store.dispatch('updateData', {
        identity: ['managed', 'disciplineStructure'],
        index: index,
        updateType: 'SPLICE_RPD_ITEM'
      })
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

.cross {
  width: 25px;
  height: 25px;
}
</style>
