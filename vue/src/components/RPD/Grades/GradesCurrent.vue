<template>
  <div>
    <div v-if="!isValid" class="error mb-4">Должны быть запролнены все поля</div>
    <div v-if="!fullIndicators" class="error mb-4">Не распределены индикаторы: {{missedIndicators.join(',')}}</div>
    <table class="table-bordered w-100">
      <thead style="border-bottom: 1px #000000 solid">
      <tr>
        <th style="width: 5%; white-space: nowrap">№ п/п</th>
        <th style="width: 25%">Наименование раздела дисциплины</th>
        <th style="width: 15%">Компетенция</th>
        <th style="width: 20%">Индикаторы достижения компетенции</th>
        <th style="width: 35%">Оценочные средства текущего контроля успеваемости</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(discipline,index) in disciplines" :key="index">
        <td>{{ index + 1 }}</td>
        <td>{{ discipline.title }}</td>
        <td>{{ getCompetencesString(discipline.competences) }}</td>
        <td>
          <MultiSelect width="90%"
                       cssClass="defaults"
                       :identity="['managed', 'disciplineStructure', index, 'indicators']"
                       :dataSource="indicators"
                       placeholder="Выберите индикаторы"
                       :ref="`comps_${index}`"
                       @change="updateCompetence($event,index);validate()"/>
        </td>
        <td>
          <div class="d-flex flex-column align-items-start p-1">
            <div class="d-flex align-items-center w-100"
                 v-for="(controlForm,id) in discipline.currentControl"
                 :key="id">
              <TextArea class="my-2"
                        rows="3"
                        :ref="`theme_${index}_control_${id}`"
                        @input="validate()"
                        :identity="getTextAreaIdentity(discipline.identity, id)"/>
              <button type="button"
                      v-if="discipline.currentControl.length > 1"
                      @click="removeResult(discipline.identity,id)"
                      class="btn btn-danger m-2">
                <BIconX-octagon class="cross"/>
              </button>
            </div>
            <button type="button"
                    @click="addResult(discipline.identity)"
                    class="btn btn-primary my-2">
              Добавить результат
            </button>
          </div>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

import TextArea from "../../UI/TextArea";
import MultiSelect from "../../UI/MultiSelect";
import {mapActions, mapState} from "vuex";
import required from "../../../mixins/required";

export default {
  name: 'GradesCurrent',
  components: {TextArea, MultiSelect},
  mixins: [required],
  data() {
    return {
      compsValid: true,
      requiredFields: [],
      noticeData: {
        order: 11,
        id: this.$store.state.rpd.static.unitTitles[9].code,
        desc: 'Оценочные материалы'
      }
    }
  },
  computed: {
    ...mapState({
      indicators: state => {
        const indicators = []

        for (let competence in state.rpd.managed.competencies) {

          for (let indicator in state.rpd.managed.competencies[competence].nextLvl) {
            if (indicators[indicator] === undefined) {
              indicators.push(indicator)
            }
          }
        }
        return indicators
      },
      disciplines: state => {
        return state.rpd.managed.disciplineStructure.map((el, i) => {

          if (el.currentControl === null) {
            el.currentControl = [{'title': ''}]
          }

          if (el.indicators === null) {
            el.indicators = []
          }

          return {
            ...el,
            'identity': ['managed', 'disciplineStructure', i, 'currentControl']
          }

        }).filter((el) => el.title !== null)
      },
      indicatorsMapping: state => {
        const indicatorsMapping = {}

        for (let competence in state.rpd.managed.competencies) {

          for (let indicator in state.rpd.managed.competencies[competence].nextLvl) {

            if (indicatorsMapping[indicator] === undefined) {
              indicatorsMapping[indicator] = competence
            }
          }
        }

        return indicatorsMapping
      }
    }),
    missedIndicators: (ctx) => {
      const filledIndicators = ctx.disciplines.reduce((acc,c) =>{
        return c.indicators.reduce((acc,c) =>{
          if (!acc.includes(c)){
            acc.push(c)
          }
          return acc
        },acc)
      },[])

      return ctx.indicators.filter((el) => !filledIndicators.includes(el))
    },
    fullIndicators: (ctx) => ctx.missedIndicators.length === 0
  },
  methods: {
    ...mapActions({
      updateData: 'rpd/updateData'
    }),
    getCompetencesString(competences) {
      return competences === null ? '' : competences.join(',')
    },
    getTextAreaIdentity(identity, ID) {
      return identity.concat([ID, 'title'])
    },
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
    updateCompetence(e, index) {
      if (e.event === null) {
        return false
      }

      const values = Object.values(e.value)
      const competences = []

      Object.entries(this.indicatorsMapping).forEach(([key, val]) => {
        if (values.includes(key) && !competences.includes(val)) {
          competences.push(val)
        }
      })

      this.updateData({
        identity: ['managed', 'disciplineStructure', index, 'competences'],
        value: competences,
        updateType: 'UPDATE_RPD_ITEM'
      });
    },
    checkRequired() {this.fullIndicators
      this.requiredFields = Object.entries(this.$refs)
          .filter(([k, v]) => {
            return (k.includes('theme') || k.includes('comps')) && v !== null
          })
          .map(([, v]) => v)
    }
  },
  updated() {
    this.checkRequired()
    this.validate()
    if (this.fullIndicators) {
      this.$store.commit('rpd/REMOVE_ERROR', this.noticeData);
    } else {
      this.$store.commit('rpd/ADD_ERROR', this.noticeData);
    }
  },
  mounted() {
    this.checkRequired()
    this.validate()
    if (this.fullIndicators) {
      this.$store.commit('rpd/REMOVE_ERROR', this.noticeData);
    } else {
      this.$store.commit('rpd/ADD_ERROR', this.noticeData);
    }
  }
}
</script>

<style scoped>
th {
  vertical-align: middle;
  padding: 10px;
}
</style>
