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
              <TextArea class="my-2" rows="3" :identity="module.identity.concat([id,'title'])"/>
              <button type="button"
                      v-if="module.SRSTypes.length > 1"
                      @click="removeResult(module.identity,id)"
                      class="btn btn-danger m-2">
                <BIconX-octagon class="cross"/>
              </button>
            </div>
            <button type="button"
                    @click="addResult(module.identity)"
                    class="btn btn-primary my-2">
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
    <h3 class="my-4"> Виды самостоятельной работы </h3>
    <div v-for="(module,index) in SRS" :key="index" class="my-4">
      <h3> {{index + 1 }}. {{ module.title }}</h3>
      <div v-for="(type,id) in module.SRSTypes" :key="id" class="my-4">
          <h4 class="my-5">{{ type.title }}</h4>
          <VisualEditor class="my-5" :identity="module.identity.concat([id,'description'])"/>
      </div>
    </div>
  </div>
</template>

<script>

import TextArea from "../../UI/TextArea";
import VisualEditor from "../../UI/VisualEditor"
import {mapActions, mapState} from "vuex";

export default {
  name: 'ModulesSRS',
  components: {TextArea, VisualEditor},
  computed:
      mapState({
        ...mapState({
          unitTitles: state => state.rpd.static.unitTitles
        }),
        SRS: state => {
          return state.rpd.managed.disciplineStructure.map((el,i) => {

            if (el.SRSTypes == null) {
              el.SRSTypes = [
                  {
                    'title': '',
                    'description' : ''
                  }
              ]
            }
            return {
              ...el,
              'identity': ['managed', 'disciplineStructure', i, 'SRSTypes']
            }
          }).filter((el) => el.load?.SRS && el.load?.SRS !== 0)
        }
      }),
  methods: {
    ...mapActions({
      updateData: 'rpd/updateData'
    }),
    addResult(identity) {
      this.updateData( {
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
  },
}
</script>

<style scoped>
th {
  vertical-align: middle;
  padding: 10px;
}
</style>
