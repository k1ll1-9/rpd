<template>
  <div class="row">
    <h3 class="my-4" :id="$store.state.rpd.static.unitTitles[3].code">
      3. {{ $store.state.rpd.static.unitTitles[3].title}}
    </h3>
    <div v-if="!isValid" class="error mb-4">Должны быть запролнены все поля</div>
    <table class="table table-bordered">
      <thead>
      <tr>
        <th class="col-3 align-middle">Код и наименование компетенции</th>
        <th class="col-3 align-middle">Код (ы) и наименование (-ия) <br>индикатора(ов) достижения компетенций</th>
        <th class="col-6 align-middle">Планируемые результаты обучения</th>
      </tr>
      </thead>
      <tbody>
      <template v-for="(competence,index,i) in managedCompetencies" :key="index">
        <tr v-for="(indicator,id,indicatorIndex) in competence.nextLvl" :key="id">
          <td class="text-start align-middle"
              :rowspan="countIndicators(competence.nextLvl)"
              v-if="indicatorIndex === 0">
            <b>{{ competence.competenceCipher }}.</b> {{ competence.name }}
          </td>
          <td class="text-start align-middle">
            <b>{{ indicator.competenceCipher }}</b>. {{ indicator.name }}
          </td>
          <td>
            <div class="d-flex flex-column align-items-start">
              <span class="my-1">Знать:</span>
              <div class="d-flex align-items-center"
                   v-for="(results,resultID) in managedCompetencies[index].nextLvl[id].results.know"
                   :key="resultID">
                <TextArea class="my-2"
                          rows="3"
                          @input="validate()"
                          :ref="`comp_${i}_ind_${indicatorIndex}_know_${resultID}`"
                          :identity="getTextAreaIdentity(index,id,'know',resultID)"
                          :disabled="$store.state.rpd.locked"/>
                <button type="button"
                        @click="removeResult(index,id,'know',resultID)"
                        v-if="Object.keys(managedCompetencies[index].nextLvl[id].results.know).length > 1"
                        class="btn btn-danger m-2"
                        :class="{'disabled' : $store.state.rpd.locked }">
                  <BIconX-octagon class="cross"/>
                </button>
              </div>
              <button type="button"
                      @click="addResult(index,id,'know')"
                      class="btn btn-primary my-2"
                      :class="{'disabled' : $store.state.rpd.locked }">
                Добавить результат
              </button>
            </div>
            <div class="d-flex flex-column align-items-start">
              <span class="my-1">Уметь:</span>
              <div class="d-flex align-items-center"
                   v-for="(results,resultID) in managedCompetencies[index].nextLvl[id].results.able"
                   :key="resultID">
                <TextArea class="my-2"
                          rows="3"
                          @input="validate()"
                          :ref="`comp_${i}_ind_${indicatorIndex}_able_${resultID}`"
                          :identity="getTextAreaIdentity(index,id,'able',resultID)"
                          :disabled="$store.state.rpd.locked"/>
                <button type="button"
                        @click="removeResult(index,id,'able',resultID)"
                        v-if="Object.keys(managedCompetencies[index].nextLvl[id].results.able).length > 1"
                        class="btn btn-danger m-2"
                        :class="{'disabled' : $store.state.rpd.locked }">
                  <BIconX-octagon class="cross"/>
                </button>
              </div>
              <button type="button"
                      @click="addResult(index,id,'able')"
                      class="btn btn-primary my-2"
                      :class="{'disabled' : $store.state.rpd.locked }">
                Добавить результат
              </button>
            </div>
            <div class="d-flex flex-column align-items-start">
              <span class="my-1">Владеть:</span>
              <div class="d-flex align-items-center"
                   v-for="(results,resultID) in managedCompetencies[index].nextLvl[id].results.master"
                   :key="resultID">
                <TextArea class="my-2"
                          rows="3"
                          @input="validate()"
                          :ref="`comp_${i}_ind_${indicatorIndex}_master_${resultID}`"
                          :identity="getTextAreaIdentity(index,id,'master',resultID)"
                          :disabled="$store.state.rpd.locked"/>
                <button type="button"
                        @click="removeResult(index,id,'master',resultID)"
                        v-if="Object.keys(managedCompetencies[index].nextLvl[id].results.master).length > 1"
                        class="btn btn-danger m-2"
                        :class="{'disabled' : $store.state.rpd.locked }">
                  <BIconX-octagon class="cross"/>
                </button>
              </div>
              <button type="button"
                      @click="addResult(index,id,'master')"
                      class="btn btn-primary my-2"
                      :class="{'disabled' : $store.state.rpd.locked }">
                Добавить результат
              </button>
            </div>
          </td>
        </tr>
      </template>
      </tbody>
    </table>
  </div>
</template>

<script>

import TextArea from "../UI/TextArea";
import {mapState, mapActions} from 'vuex'
import required from "@/mixins/required";

export default {
  name: "Competencies",
  mixins: [required],
  components: {TextArea},
  data() {
    return {
      requiredFields: [],
      noticeData: {
        order: 3,
        id: this.$store.state.rpd.static.unitTitles[3].code,
        desc: 'Компетенции обучающихся, формируемые в результате освоения дисциплины'
      }
    }
  },
  computed: {
    ...mapState({
      managedCompetencies: state => state.rpd.managed.competencies,
    })
  },
  methods: {
    ...mapActions({
      updateData: 'rpd/updateData'
    }),
    countIndicators(indicators) {
      return Object.keys(indicators).length
    },
    getTextAreaIdentity(compID, indID, resType, resultID) {
      return this.getIdentity(compID, indID, resType).concat([resultID, 'value'])
    },
    getIdentity(compID, indID, resType) {
      return ['managed', 'competencies', compID, 'nextLvl', indID, 'results', resType]
    },
    async addResult(compID, indID, resType) {
      await this.updateData({
        identity: this.getIdentity(compID, indID, resType),
        updateType: 'PUSH_RPD_ITEM'
      })
      this.checkRequired()
      this.validate()
    },
    async removeResult(compID, indID, resType, index) {
      await this.updateData({
        identity: this.getIdentity(compID, indID, resType),
        index: index,
        updateType: 'SPLICE_RPD_ITEM'
      })
      this.checkRequired()
      this.validate()
    },
    checkRequired(){
      this.requiredFields = Object.entries(this.$refs)
          .filter(([k,v]) => k.includes('comp') && v !== null)
          .map(([, v]) => v)
    }
  },
  mounted() {
    this.checkRequired()
    this.validate()
  }
}
</script>

<style scoped>
ul li {
  list-style: none;
}
.red{
  color: red;
}
.white{
  color: white;
}
textarea {
  width: 600px;
}
</style>
