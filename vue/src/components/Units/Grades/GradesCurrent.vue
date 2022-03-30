<template>
  <div>
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
                       @change="updateCompetence($event,index)"/>
        </td>
        <td>
          <div class="d-flex flex-column align-items-start p-1">
            <div class="d-flex align-items-center w-100"
                 v-for="(controlForm,ID) in discipline.currentControl"
                 :key="ID">
              <TextArea class="my-2" rows="3" :identity="getTextAreaIdentity(discipline.identity, ID)"/>
              <button type="button"
                      v-if="discipline.currentControl.length > 1"
                      @click="removeResult(discipline.identity,ID)"
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
import {mapState} from "vuex";

export default {
  name: 'GradesCurrent',
  components: {TextArea, MultiSelect},
  computed:
      mapState({
        indicators: state => {
          const indicators = []

          for (let competence in state.managed.competencies) {

            for (let indicator in state.managed.competencies[competence].nextLvl) {
              if (indicators[indicator] === undefined) {
                indicators.push(indicator)
                /*       indicators[indicator] = {
                         ...state.managed.competencies[competence].nextLvl[indicator],
                         "competence": competence
                       }*/
              }
            }
          }
          return indicators
        },
        disciplines: state => {
          return state.managed.disciplineStructure.map((el, i) => {

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

          for (let competence in state.managed.competencies) {

            for (let indicator in state.managed.competencies[competence].nextLvl) {

              if (indicatorsMapping[indicator] === undefined) {
                indicatorsMapping[indicator] = competence
              }
            }
          }

          return indicatorsMapping
        }
      }),
  methods: {
    getCompetencesString(competences){
      return competences === null ? '' : competences.join(',')
    },
    getTextAreaIdentity(identity, ID) {
      return identity.concat([ID, 'title'])
    },
    addResult(identity) {
      this.$store.dispatch('updateData', {
        identity: identity,
        updateType: 'PUSH_RPD_ITEM'
      })
    },
    removeResult(identity, index) {
      this.$store.dispatch('updateData', {
        identity: identity,
        index: index,
        updateType: 'SPLICE_RPD_ITEM'
      })
    },
    updateCompetence(e, index) {
      const values = Object.values(e.value)
      const competences = []

      Object.entries(this.indicatorsMapping).forEach(([key, val]) => {
        if (values.includes(key) && !competences.includes(val)) {
          competences.push(val)
        }
      })

      this.$store.dispatch('updateData', {
        identity: ['managed', 'disciplineStructure', index, 'competences'],
        value: competences,
        updateType: 'UPDATE_RPD_ITEM'
      });

    }
  },
}
</script>

<style scoped>
th {
  vertical-align: middle;
  padding: 10px;
}
</style>
