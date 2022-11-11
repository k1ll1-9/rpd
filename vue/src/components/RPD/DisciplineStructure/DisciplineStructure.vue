<template>
  <div id="disciplineStructureTable">
    <h3 class="my-5" id="disciplineStructure">Структура и содержание дисциплины (модуля)</h3>
    <div v-if="!isValid" class="error mb-4">Необходимо заполнить название темы и номер семестра</div>
    <div v-if="!isValidHours" class="error mb-4">Неправильно распределена нагрузка</div>
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
                         @input="validateFull();checkAllHours()"
                         :disabled="$store.state.rpd.locked"/>
            </td>
            <td>
              <Select :identity="['managed','disciplineStructure',index,'semester']"
                      :dataSource="$store.state.rpd.static.semesters"
                      cssClass="defaults"
                      :ref="`disc_semester_${index}`"
                      @change="validateFull();checkAllHours()"
                      width="60%"
                      :readonly="$store.state.rpd.locked"/>
            </td>
            <td>
              <DigitInput
                  :class="[{'invalid' : errors.lectures?.[disciplineStructure[index].semester] === true},'text-center']"
                  @input="checkHours(disciplineStructure[index].semester,['lectures'],index,$event)"
                  :identity="['managed','disciplineStructure',index,'load','lectures']"
                  :disabled="$store.state.rpd.locked"/>
            </td>
            <td>
              <DigitInput
                  :class="[{'invalid' : errors.seminars?.[disciplineStructure[index].semester] === true},'text-center']"
                  @input="checkHours(disciplineStructure[index].semester,['seminars'],index,$event)"
                  :identity="['managed','disciplineStructure',index,'load','seminars']"
                  :disabled="$store.state.rpd.locked"/>
            </td>
            <td>
              <DigitInput
                  :class="[{'invalid' : errors.SRS?.[disciplineStructure[index].semester] === true},'text-center']"
                  @input="checkHours(disciplineStructure[index].semester,['SRS'],index,$event)"
                  :identity="['managed','disciplineStructure',index,'load','SRS']"
                  :disabled="$store.state.rpd.locked"/>
            </td>
            <td>
              <DigitInput class='text-center'
                          :identity="['managed','disciplineStructure',index,'load','practicePrepare']"
                          :disabled="$store.state.rpd.locked"/>
            </td>
            <td style="min-width: 62px">
              <button type="button" v-show="disciplineStructure.length > 1"
                      @click="removeRow(index);checkAllHours()"
                      class="btn btn-danger px-3"
                      :class="{'disabled' : $store.state.rpd.locked}">
                <BIconX-octagon class="cross"/>
              </button>
            </td>
          </tr>
          </tbody>
        </table>
        <div>
          <button type="button"
                  @click="addRow"
                  class="btn btn-primary mt-4"
                  :class="{'disabled' : $store.state.rpd.locked}">
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
      loadTypes: ['lectures', 'SRS', 'seminars'],
      errors: {},
      requiredFields: [],
      noticeData: {
        order: 4,
        id: 'disciplineStructureTable',
        desc: 'Структура и содержание дисциплины (модуля)'
      }
    }
  },
  computed: {
    ...mapState({
      disciplineStructure: state => state.rpd.managed.disciplineStructure,
      value: state => Object.fromEntries(Object.entries(state.rpd.static.disciplineValue).map(([k, v]) => {
        //если тип нагрузки в семестре не задан - назначаем его равным 0
        v.semesters = Object.fromEntries(Object.entries(v.semesters).map(([k, v]) => [k, {
          ...v,
          quantity: v.quantity ??= 0
        }]))
        //костыль для разрешения несоответствия названий нагрузки семинаров
        if (k === 'practice') {
          return ['seminars', v]
        } else {
          return [k, v]
        }
      })),
    }),
    semesters: ctx => Object.keys(Object.values(ctx.value)[0].semesters),
    isValidHours: ctx => Object.values(ctx.errors).filter((el) => Object.values(el).includes(true)).length === 0
  },
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
    checkHours(semester, types, index = null, $event) {

      if (!semester) {
        return
      }

      types.forEach((type) => {
        const currentHours = Object.values(this.disciplineStructure)
            .reduce((acc, v, k) => {

              if (v.load?.[type] === undefined && index !== null) {
                v.load = v.load || {}
                v.load[type] = parseInt($event.target.value) || 0
              } else if (v.load === null) {
                return acc
              }

              if (type in v.load && v.semester === parseInt(semester)) {

                if (index !== null && index === k) {
                  const val = parseInt($event.target.value) || 0
                  return acc + val
                } else {
                  v.load[type] ??= 0
                  return acc + v.load[type]
                }
              } else {
                return acc
              }
            }, 0)

        if (currentHours !== this.value[type].semesters[semester]?.quantity) {
          (this.errors[type] ??= {})[semester] = true
        } else {
          (this.errors[type] ??= {})[semester] = false
        }
      })

      if (this.isValidHours && this.isValid) {
        this.$store.commit('rpd/REMOVE_ERROR', this.noticeData);
      } else {
        this.$store.commit('rpd/ADD_ERROR', this.noticeData);
      }

    },
    checkAllHours() {
      this.semesters.forEach((el) => this.checkHours(el, this.loadTypes))
    },
    checkRequired() {
      this.requiredFields = Object.entries(this.$refs)
          .filter(([k, v]) => k.includes('disc') && v !== null)
          .map(([, v]) => v)
    },
    validateFull() {
      this.validate();
      if (this.isValid && this.isValidHours) {
        this.$store.commit('rpd/REMOVE_ERROR', this.noticeData);
      } else if (!this.isValid && this.isValidHours) {
        this.$store.commit('rpd/ADD_ERROR', this.noticeData);
      }
    }
  },
  updated() {
    this.checkRequired()
    this.validate()
  },
  mounted() {
    this.checkAllHours()
    this.checkRequired()
    this.validate()
  }
}
</script>

<style scoped>
h3 {
  margin: 40px 0 0;
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
