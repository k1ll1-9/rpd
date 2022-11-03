<template>
  <div>
    <h3 class="my-5" id="disciplineStructure">Структура и содержание дисциплины (модуля)</h3>
    <div v-if="!isValid" class="error mb-4">Необходимо заполнить название темы и номер семестра</div>
    <div class="row">
      <div class="col">
        <table class="table-bordered">
          <thead style="border-bottom: 1px #000000 solid">
          <tr>
            <th class="col-1" rowspan="2">№ п/п</th>
            <th class="col-5" rowspan="2">Наименование темы дисциплины</th>
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
          <tr v-for="(discipline,index) in disciplineStructure" :key="discipline.title + discipline.semester || index">
            <td>
              {{ index + 1 }}
            </td>
            <td>
              <TextInput :identity="['managed','disciplineStructure',index,'title']"
                         :ref="`disc_title_${index}`"
                         @input="validate()"/>
            </td>
            <td>
              <Select :identity="['managed','disciplineStructure',index,'semester']"
                      :dataSource="$store.state.rpd.static.semesters"
                      cssClass="defaults"
                      :ref="`disc_semester_${index}`"
                      @change="validate()"
                      width="60%"/>
            </td>
            <td>
              <DigitInput class='text-center'
                          @change="checkHours(disciplineStructure[index].semester,'lectures')"
                          :identity="['managed','disciplineStructure',index,'load','lectures']"/>
            </td>
            <td>
              <DigitInput class='text-center'
                          @change="checkHours(disciplineStructure[index].semester,'seminars')"
                          :identity="['managed','disciplineStructure',index,'load','seminars']"/>
            </td>
            <td>
              <DigitInput class='text-center'
                          @change="checkHours(disciplineStructure[index].semester,'SRS')"
                          :identity="['managed','disciplineStructure',index,'load','SRS']"/>
            </td>
            <td>
              <DigitInput class='text-center'
                          :identity="['managed','disciplineStructure',index,'load','practicePrepare']"/>
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

import {mapState, mapActions} from 'vuex'
import TextInput from "../../UI/TextInput";
import DigitInput from "../../UI/DigitInput";
import Select from "../../UI/Select";
import required from "../../../mixins/required";

export default {
  components: {Select, TextInput, DigitInput},
  name: 'DisciplineStructure',
  mixins: [required],
  data() {
    return {
      requiredFields: [],
      noticeData: {
        order: 4,
        id: 'disciplineStructure',
        desc: 'Структура и содержание дисциплины (модуля)'
      }
    }
  },
  computed:
      mapState({
        disciplineStructure: state => state.rpd.managed.disciplineStructure,
        value: state => state.rpd.static.disciplineValue,
      }),
  methods: {
    ...mapActions({
      updateData: 'rpd/updateData'
    }),
    addRow() {
      this.updateData({identity: ['managed', 'disciplineStructure'], updateType: 'PUSH_RPD_ITEM'})
    },
    removeRow(index) {
      this.updateData({
        identity: ['managed', 'disciplineStructure'],
        index: index,
        updateType: 'SPLICE_RPD_ITEM'
      })
    },
    checkHours(semester, type) {

      if (!semester) {
        return
      }

      const currentHours = Object.values(this.disciplineStructure)
          .reduce((acc, v) => type in v.load && v.semester === semester ? acc + v.load[type] : acc, 0)

      if (currentHours !== this.value[type].semesters[semester].quantity){
        console.log('YOBA')
      }

    },
    checkRequired() {
      this.requiredFields = Object.entries(this.$refs)
          .filter(([k, v]) => k.includes('disc') && v !== null)
          .map(([, v]) => v)
    }
  },
  updated() {
    this.checkRequired()
    this.validate()
  },
  mounted() {
    this.checkRequired()
    this.validate()
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
