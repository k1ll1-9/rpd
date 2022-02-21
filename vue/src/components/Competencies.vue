<template>
  <div class="row">
    <h3 class="my-4"><strong>КОМПЕТЕНЦИИ ОБУЧАЮЩИХСЯ, ФОРМИРУЕМЫЕ В РЕЗУЛЬТАТЕ ОСВОЕНИЯ ДИСЦИПЛИНЫ</strong></h3>
    <table class="table table-bordered">
      <thead>
      <tr>
        <th class="col-3">Код и наименование компетенции</th>
        <th class="col-3">Код (ы) и наименование (-ия) <br>индикатора(ов) достижения компетенций</th>
        <th class="col-6">Планируемые результаты обучения</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(results,index) in competence" :key="index">
        <td class="text-start"><b>{{ competence.competenceCipher }}</b>. {{ competence.name }}</td>
      </tr>
      <tr v-for="(competence,index) in $store.state.competencies" :key="index">
        <td class="text-start"><b>{{ competence.competenceCipher }}</b>. {{ competence.name }}</td>
        <td class="p-0">
          <table class="table table-bordered mb-0">
            <tbody>
            <tr v-for="(indicator,id) in competence.nextLvl" :key="id">
              <td class="text-start">
                <b>{{ indicator.competenceCipher }}</b>. {{ indicator.name }}
              </td>
            </tr>
            </tbody>
          </table>

        </td>
        <table class="table table-bordered mb-0">
          <tbody>
          <div v-for="(indicator,id) in competence.nextLvl" :key="id">
            <tr v-for="(arResult,resultType) in indicator.results" :key="resultType">
              <td>
               <p class="text-start mb-0 p-2">{{ getName(resultType) }}</p>
              <ul class="p-2 mb-0">
                <li v-for="(value,name) in arResult" :key="name">
                  <TextArea :identity="['managed','competencies',index,'nextLvl',id,'results','resultType',name]"/>
                </li>
              </ul>
              </td>
            </tr>
          </div>
          </tbody>
        </table>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

import TextArea from "./TextArea";

export default {
  components: {TextArea},
  name: "Competencies",
  computed: {},
  methods: {
    getName(prop) {
      if (prop === 'know') {
        return 'Знать:'
      } else if (prop === 'own') {
        return 'Владеть:'
      } else if (prop === 'can') {
        return 'Уметь:'
      }
    }
  }
}
</script>

<style scoped>
ul li{
  list-style: none;
}
textarea {
  width: 600px;
}
</style>
