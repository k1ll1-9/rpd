<template>
  <div v-if="RPDList">
    <template v-if="type === 'plans'">
      <h2 class="my-2">Список РПД учебного плана</h2>
      <h2 class="my-4">{{ syllabus.special }} - {{ syllabus.profile }} -
        {{ (new Date(syllabus.year)).getFullYear() }}</h2>
      <h2 class="my-4">Уровень подготовки: {{ syllabus.qualification }}</h2>
      <h2 class="my-4">Форма обучения: {{ syllabus.educationForm }}</h2>
      <SyllabusFiles :files="files" :syllabusID="syllabus.syllabusID"/>
    </template>
    <template v-else>
      <h2 class="my-2">{{ RPDList[0].kafedra }} </h2>
      <h3 class="my-5">Список РПД </h3>
    </template>
    <table class="table my-5" v-if="RPDList">
      <thead>
      <tr>
        <th>№</th>
        <th>Код</th>
        <th>Дисциплина</th>
        <th v-if="type === 'plans'">Кафедра</th>
        <th>РПД</th>
        <th>Статус</th>
        <th>Статус согласования</th>
        <th>Согласованная РПД</th>
        <th>Скачать РПД</th>
        <th>Загрузить РПД</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(rpd, index) in RPDList" :key="index" :class="{ 'text-decoration-line-through' : !rpd.actual }">
        <td>{{ index + 1 }}</td>
        <td>{{ rpd.disciplineIndex }}</td>
        <td>
          {{ rpd.name }}
          <div v-if="type === 'kafs'">
            <router-link
              v-if="rpd.actual"
              :to="{path : '/list', query : { type: 'plans', id: rpd.syllabusData.syllabusID}}"
              class="btn btn-primary h-auto w-100 my-2"
            >
              {{ rpd.syllabusData.educationForm[0] }} {{ rpd.syllabusData.formOfTraining[0] }}
              {{ rpd.syllabusData.special[0] }} {{ rpd.syllabusData.profile }}
              {{ (new Date(rpd.syllabusData.year)).getFullYear() }}
            </router-link>
            <span v-else class="btn btn-primary h-auto w-100 my-2 disabled">
                  {{ rpd.syllabusData.educationForm[0] }} {{ rpd.syllabusData.formOfTraining[0] }}
              {{ rpd.syllabusData.special[0] }} {{ rpd.syllabusData.profile }}
              {{ (new Date(rpd.syllabusData.year)).getFullYear() }}
            </span>
          </div>
        </td>
        <td v-if="type === 'plans'">{{ rpd.kafedra }}</td>
        <td>
          <router-link :to="{path : '/rpd', query : rpd.query}"
                       :class="['btn d-flex align-items-center justify-content-center',getButtonClass(rpd)]">
            {{ (rpd.status === 'blank') ? 'Создать' : 'Редактировать' }} <br> РПД
          </router-link>
        </td>
        <td :class="rpd.valid === 'valid' ? 'text-success' : 'text-danger'"><b>{{ getValidationStatus(rpd) }}</b></td>
        <td :class="getApprovalClass(rpd)"><b>{{ getApprovalStatus(rpd) }}</b></td>
        <td class="fw-bold">
          <a v-if="rpd.approvedLink"
             :href="rpd.approvedLink"
             target="_blank"
             class="text-success">Ссылка</a>
          <span v-else class="text-danger">Нет</span>
        </td>
        <td>
          <div
            v-if="(rpd.status !== 'blank')"
            @click="exportRPD(rpd.query)"
            class="btn-import"
            data-bs-toggle="tooltip"
            data-bs-placement="bottom"
            title="скачать файл РПД"
          >
            <BIconDownload width="25" height="25"/>
          </div>
        </td>
        <td>
          <div
            class="btn-import"
            data-bs-toggle="tooltip"
            data-bs-placement="bottom"
            title="загрузить РПД из файла"
          >
            <label :for="`RPD_file_${rpd.code}_${index}`" class="file-label">
              <BIconUpload width="25" height="25"/>
            </label>
            <input
              accept=".json"
              type="file"
              class="d-none"
              :name="`RPD_file_${rpd.code}_${index}`"
              :id="`RPD_file_${rpd.code}_${index}`"
              @change="readRPD(rpd,index)"
            >
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
import SyllabusFiles from "@/components/RPDList/SyllabusFiles";
import Preloader from "@/components/Misc/Preloader";
import ModalWarning from "@/components/UI/ModalWarning";
import {Modal} from 'bootstrap'
import {Tooltip} from 'bootstrap'

export default {
  name: "RPDList",
  components: {
    SyllabusFiles,
    ModalWarning,
    Preloader
  },
  data() {
    return {
      json: null,
      RPDList: null,
      files: null,
      syllabus: null, //информация УП для компонетов файла УП и заголовков,
      RPD2import: {},
      type: this.$route.query.type
    }
  },
  async created() {

    let action

    if (this.type === 'plans') {
      action = 'getRPDList'
    } else if (this.type === 'kafs') {
      action = 'getRPDListByKaf'
    }

    const res = await this.axios.get(this.$store.state.APIurl,
      {
        params: {
          action: action,
          params: this.$route.query
        }
      });

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
        valid: el.valid,
        approval: el.approval,
        approvedLink: el.approvedLink,
        query: {
          syllabusID: json.syllabusData.syllabusID,
          kafedra: json.kafedra,
          code: json.code
        }
      }
    })

    if (this.type === 'plans') {

      this.files = res.data.syllabusFiles

      this.syllabus = {
        special: this.RPDList[0].syllabusData.special,
        profile: this.RPDList[0].syllabusData.profile,
        year: this.RPDList[0].syllabusData.year,
        educationForm: this.RPDList[0].syllabusData.formOfTraining,
        qualification: this.RPDList[0].syllabusData.educationLevel,
        syllabusID: this.RPDList[0].syllabusData.syllabusID
      }
    }

  },
  updated() {
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(
      (el) => {
        new Tooltip(el)
      })
  },
  methods: {
    getValidationStatus(rpd) {
      switch (rpd.valid) {
        case'valid':
          return 'Заполнена'
        case'needCheck':
          return 'Необходима проверка'
        default:
          return 'Не заполнена'
      }
    },
    getApprovalStatus(rpd) {
      switch (rpd.approval) {
        case'approved':
          return 'Согласована'
        case'inProcess':
          return 'На согласовании'
        default:
          return 'Не согласована'
      }
    },
    getApprovalClass(rpd) {
      switch (rpd.approval) {
        case'approved':
          return 'text-success'
        case'inProcess':
          return 'text-warning'
        default:
          return 'text-danger'
      }
    },
    getButtonClass(rpd) {
      const buttonClass = []

      if (rpd.valid === 'valid') {
        buttonClass.push('btn-success')
      } else {
        switch (rpd.status) {
          case 'blank':
            buttonClass.push('btn-danger')
            break
          case 'progress':
            buttonClass.push('btn-warning')
            break
        }
      }
      if (!rpd.editable) {
        buttonClass.push('disabled')
      }
      return buttonClass
    },
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
      if (res.data.size !== 0) {
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
      }
    },
    async readRPD(rpd, index) {
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

      if (res.data.success === true) {
        this.RPDList[this.RPD2import.index].status = 'progress'
      }
    }
  }
}
</script>

<style scoped>
td, th {
  vertical-align: middle;
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

