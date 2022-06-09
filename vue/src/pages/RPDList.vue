<template>
  <div v-if="ready" class="container-fluid">
    <h2 class="my-2">Учебный план</h2>
    <h2 class="my-4">{{ syllabus.special }} - {{ syllabus.profile }} -
      {{ (new Date(syllabus.year)).getFullYear() }}</h2>
    <h2 class="my-4">Уровень подготовки: {{ syllabus.qualification }}</h2>
    <h2 class="my-4">Форма обучения: {{ syllabus.educationForm }}</h2>
    <SyllabusFiles :files="files" :syllabus="syllabus"/>
    <table class="table my-5" v-if="RPDList">
      <thead>
      <tr>
        <th>№</th>
        <th>Код</th>
        <th>Дисциплина</th>
        <th>Кафедра</th>
        <th>РПД</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(rpd, index) in RPDList" :key="index" :class="{ outdated : !rpd.actual }">
        <td>{{ index + 1 }}</td>
        <td>{{ rpd.disciplineIndex }}</td>
        <td>{{ rpd.name }}</td>
        <td>{{ rpd.kafedra }}</td>
        <td>
          <router-link :to="{path : '/rpd', query : rpd.query}"
                       class="btn btn-primary d-flex align-items-center justify-content-center"
                       :class="{disabled: !rpd.editable }">
            {{ (rpd.status === 'blank') ? 'Создать' : 'Редактировать' }} РПД
          </router-link>
        </td>
      </tr>
      </tbody>
    </table>
    <Preloader v-else style="margin-top: 200px"/>
  </div>
</template>

<script>
import Preloader from "../components/Misc/Preloader";
import SyllabusFiles from "@/components/RPDList/SyllabusFiles";

export default {
  name: "RPDList",
  components: {
    Preloader,
    SyllabusFiles
  },
  data() {
    return {
      ready: false,
      RPDList: null,
      files: null,
      syllabus: null //информация УП для компонетов файла УП и заголовков
    }
  },
  async mounted() {
    const res = await this.axios.get(this.$store.state.APIurl,
        {
          params: {
            action: "getRPDList",
            params: this.$route.query
          }
        });

    this.ready = true
    this.files = res.data.syllabusFiles

    this.RPDList = res.data.list.map((el) => {
      const json = JSON.parse(el.json)
      return {
        ...json,
        editable: this.$store.state.user.departmentString.includes(json.kafedra)
            || this.$store.state.user.role === 'admin'
            || this.$store.state.user.role === 'editor'
            || process.env.NODE_ENV === 'development',
        actual: el.actual,
        status: el.status,
        query: {
          special: json.syllabusData.special,
          profile: json.syllabusData.profile,
          year: json.syllabusData.year,
          name: json.name,
          kafedra: json.kafedra,
          qualification: el.qualification,
          educationForm: el.education_form
        }
      }
    })

    this.syllabus = {
      special: this.RPDList[0].syllabusData.special,
      profile: this.RPDList[0].syllabusData.profile,
      year: this.RPDList[0].syllabusData.year,
      educationForm: this.RPDList[0].syllabusData.formOfTraining,
      qualification: this.RPDList[0].syllabusData.educationLevel
    }
  }
}
</script>

<style scoped>
td {
  vertical-align: middle;
}

.outdated {
  text-decoration: line-through;
}

.btn-primary {
  height: 60px;
  width: 145px;
}
</style>

