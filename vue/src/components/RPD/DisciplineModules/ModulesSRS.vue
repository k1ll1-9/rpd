<template>
  <div class="my-5">
    <h3 class="my-4" :id="unitTitles[5].subUnits[3].code">
      5.3 {{ unitTitles[5].subUnits[3].title }}
    </h3>
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
        <td>
          <div class="d-flex flex-column align-items-start p-1">
            <div class="d-flex align-items-center w-100"
                 v-for="(type,id) in module.SRSTypes"
                 :key="id">
              <TextArea
                  class="my-2"
                  rows="3"
                  :ref="`theme_${index}_SRSType_${id}`"
                  @input="validate()"
                  :identity="module.identity.concat([id,'title'])"
                  :disabled="$store.state.rpd.locked"/>
              <button type="button"
                      v-if="module.SRSTypes.length > 1"
                      @click="removeResult(module.identity,id)"
                      class="btn btn-danger m-2"
                      :class="{'disabled' : $store.state.rpd.locked}">
                <BIconX-octagon class="cross"/>
              </button>
            </div>
            <button type="button"
                    @click="addResult(module.identity)"
                    class="btn btn-primary my-2"
                    :class="{'disabled' : $store.state.rpd.locked}">
              Добавить вид работы
            </button>
          </div>
        </td>
        <td>{{ module.load.SRS }}</td>
      </tr>
      </tbody>
    </table>
  </div>
  <div class="my-5">
    <h4 class="my-4"> Виды самостоятельной работы </h4>
    <div v-for="(semester,index) in SRSDescription" :key="index" class="my-4">
      <h4 v-if="count(SRSDescription) >1"> Семестр {{ index }}</h4>
      <div v-for="(theme,id) in semester" :key="id" class="my-4">
        <h4 class="my-5"> Тема {{ id }} . {{ theme.title }}</h4>
        <div v-for="(type,SRSid) in theme.SRSTypes" :key="SRSid" class="my-4">
          <h4 class="my-5">{{ type.title }}</h4>
          <VisualEditor
              :ref="`semester_${index}_theme_${id}_SRSDesc_${SRSid}`"
              @input="validate()"
              class="my-5"
              :identity="type.identity"
              :readonly="$store.state.rpd.locked"/>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

import TextArea from "../../UI/TextArea";
import VisualEditor from "../../UI/VisualEditor"
import {mapActions, mapState} from "vuex";
import required from "../../../mixins/required";

export default {
  name: 'ModulesSRS',
  components: {TextArea, VisualEditor},
  mixins: [required],
  data() {
    return {
      requiredFields: [],
      noticeData: {
        order: 7,
        id: this.$store.state.rpd.static.unitTitles[5].subUnits[3].code,
        desc: 'Программа самостоятельной работы студентов'
      }
    }
  },
  computed: {
    ...mapState({
      unitTitles: state => state.rpd.static.unitTitles,
      SRS: state => {
        return state.rpd.managed.disciplineStructure.map((el, i) => {

          if (el.SRSTypes == null) {
            el.SRSTypes = [
              {
                'title': '',
                'description': ''
              }
            ]
          }
          return {
            ...el,
            'identity': ['managed', 'disciplineStructure', i, 'SRSTypes']
          }
        }).filter((el) => el.load?.SRS && el.load?.SRS !== 0)
      },
      SRSDescription: state => {

        const modules = {}

        state.rpd.managed.disciplineStructure.map((el, i) => {

          if (el.title === null || el.semester === null || (!el.load?.SRS)) {
            return;
          }

          if (modules[el.semester] === undefined) {
            modules[el.semester] = {};
          }

          if (modules[el.semester][i + 1] === undefined) {
            modules[el.semester][i + 1] = {};
            modules[el.semester][i + 1].title = el.title
          }

          if (el.SRSTypes == null) {
            modules[el.semester][i + 1].SRSTypes = [
              {
                'title': '',
                'description': '',
                'identity': ['managed', 'disciplineStructure', i, 'SRSTypes', 0]
              }
            ]
          } else {
            modules[el.semester][i + 1].SRSTypes = el.SRSTypes.map((el, index) => {
              return {
                ...el,
                'identity': ['managed', 'disciplineStructure', i, 'SRSTypes', index, 'description']
              }
            })
          }
        })
        return modules;
      }
    })
  },
  methods: {
    ...mapActions({
      updateData: 'rpd/updateData'
    }),
    addResult(identity) {
      this.updateData({
        identity: identity,
        updateType: 'PUSH_RPD_ITEM'
      })
    },
    removeResult(identity, index) {
      this.updateData({
        identity: identity,
        index: index,
        updateType: 'SPLICE_RPD_ITEM'
      })
    },
    count($module) {
      return Object.keys($module).length
    },
    checkRequired() {
      this.requiredFields = Object.entries(this.$refs)
          .filter(([k, v]) => {  return  k.includes('SRS') && v !== null})
          .map(([, v]) => v[0])
    }
  },
  updated(){
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
th {
  vertical-align: middle;
  padding: 10px;
}
</style>
