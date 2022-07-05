<template>
  <div v-if="ready" class="container-fluid">
    <h2 class="my-2">Учебный план</h2>
    <h2 class="my-4">{{ syllabus.special }} - {{ syllabus.profile }} -
      {{ (new Date(syllabus.year)).getFullYear() }}</h2>
    <h2 class="my-4">Уровень подготовки: {{ syllabus.qualification }}</h2>
    <h2 class="my-4">Форма обучения: {{ syllabus.educationForm }}</h2>
    <SyllabusFiles :files="files" :syllabusID="syllabus.syllabusID"/>
    <table class="table my-5" v-if="RPDList">
      <thead>
      <tr>
        <th>№</th>
        <th>Код</th>
        <th>Дисциплина</th>
        <th>Кафедра</th>
        <th>РПД</th>
        <th>Экспорт</th>
        <th>Импорт</th>
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
        <td>
          <div v-if="(rpd.status !== 'blank')" @click="exportRPD(rpd.query)" class="btn-import">
            <BIconDownload width="25" height="25"/>
          </div>
        </td>
        <td>
          <div class="btn-import">
            <label for="file" class="file-label">
              <BIconUpload width="25" height="25"/>
            </label>
            <input @change="importRPD()" type="file" name="formFile" class="d-none" id="file">
          </div>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
  <Preloader v-else style="margin-top: 200px"/>
  <Modal></Modal>
</template>

<script>
import Preloader from "../components/Misc/Preloader";
import SyllabusFiles from "@/components/RPDList/SyllabusFiles";
import Modal from "@/components/UI/Modal";

export default {
  name: "RPDList",
  components: {
    Preloader,
    SyllabusFiles,
    Modal
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
          syllabusID: json.syllabusData.syllabusID,
          kafedra: json.kafedra,
          code: json.code
        }
      }
    })

    this.syllabus = {
      special: this.RPDList[0].syllabusData.special,
      profile: this.RPDList[0].syllabusData.profile,
      year: this.RPDList[0].syllabusData.year,
      educationForm: this.RPDList[0].syllabusData.formOfTraining,
      qualification: this.RPDList[0].syllabusData.educationLevel,
      syllabusID: this.RPDList[0].syllabusData.syllabusID
    }
  },
  methods: {
    async exportRPD(params) {
      const res = await this.axios.post(
          this.$store.state.APIurl,
          {
            action: 'exportRPD',
            params: params
          }, {
            responseType: 'blob'
          }
      )
      console.log(Object.entries(params));
      //отдаем как файл полученный JSON
      const url = window.URL.createObjectURL(new Blob([res.data]))
      const link = document.createElement('a')
      const fileName = Object.entries(params).map(([, v]) => v).join('_')

      link.href = url;
      link.setAttribute('download', fileName)
      document.body.appendChild(link)
      link.click();
      document.body.removeChild(link)
      window.URL.revokeObjectURL(url)
    },
    async importRPD() {

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

.btn-import {
  cursor: pointer;
  display: inline-block;
}
.file-label{
  cursor:pointer;
}
</style>

