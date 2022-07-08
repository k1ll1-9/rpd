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
            <label :for="`RPD_file_${rpd.code}`" class="file-label">
              <BIconUpload width="25" height="25"/>
            </label>
            <input @change="readRPD(rpd,index)" type="file" :name="`RPD_file_${rpd.code}`" class="d-none"
                   :id="`RPD_file_${rpd.code}`">
          </div>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
  <Preloader v-else style="margin-top: 200px"/>
  <ModalWarning id="importRPDModal" @confirm="importRPD">
    <template v-slot:title>
      Импорт РПД
    </template>
    <template v-slot:body>
      При импорте РПД все текущие данные будут потеряны. Продолжить?
    </template>
  </ModalWarning>
</template>

<script>
import Preloader from "../components/Misc/Preloader";
import SyllabusFiles from "@/components/RPDList/SyllabusFiles";
import ModalWarning from "@/components/UI/ModalWarning";
import {Modal} from 'bootstrap'

export default {
  name: "RPDList",
  components: {
    Preloader,
    SyllabusFiles,
    ModalWarning
  },
  data() {
    return {
      ready: false,
      json: null,
      RPDList: null,
      files: null,
      syllabus: null, //информация УП для компонетов файла УП и заголовков,
      RPD2import: {}
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
      const fileName = Object.entries(params).map(([, v]) => v).join('_') + '.json'

      link.href = url;
      link.setAttribute('download', fileName)
      document.body.appendChild(link)
      link.click();
      document.body.removeChild(link)
      window.URL.revokeObjectURL(url)
    },
    async readRPD(rpd,index) {
      //читаем JSON из загруженного файла

      const readJSON = () => {

        const fr = new FileReader()

        return new Promise((resolve, reject) => {
          fr.onload = e => {
            let json

            try {
              json = JSON.parse(e.target.result)
            } catch (e) {
              reject(e)
            }
            resolve(json)
          }
          fr.onerror = reject
          fr.readAsText(event.target.files[0])
        })
      }

      const _input = event.target

      this.RPD2import.data = await readJSON().catch(e => console.log(e))

      if (typeof (this.RPD2import.data) !== 'undefined') {

        this.RPD2import.params = {
          code: rpd.code,
          syllabusID: rpd.syllabusData.syllabusID,
          kafedra: rpd.kafedra
        }
        this.RPD2import.index = index

        const modal = new Modal(document.getElementById('importRPDModal'))

        modal.show()
      }

      _input.value = null
    },
    async importRPD() {
      const res = await this.axios.post(this.$store.state.APIurl,
          {
              action: "importRPD",
              params: this.RPD2import.params,
              data: this.RPD2import.data
          })

      if (res.data.success === true){
        this.RPDList[this.RPD2import.index].status = 'progress'
      }
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

.file-label {
  cursor: pointer;
}
</style>

