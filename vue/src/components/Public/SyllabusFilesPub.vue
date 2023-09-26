<template>
  <div class="row mt-5">
    <div v-for="(file,index) in fileList" :key="index" class="col-3 mb-2">
      <div class="alert alert-primary" role="alert">
        {{ file.title }}
      </div>
      <div v-for="(link,i) in file.arFiles" :key="i" class="my-2">
        <a :href="'https://lk.vavt.ru/helpers/getFile.php?fileSSL='+link.path" target="_blank">
          {{ link.name }}
        </a>
      </div>
    </div>
  </div>
  <ModalWarning id="uploadWarning" passive="true">
    <template v-slot:title>
      Ошибка загрузки файла
    </template>
    <template v-slot:body>
      Файл ЭЦП не соответсвет ни одному загруженному документу.
    </template>
  </ModalWarning>
</template>

<script>
import ModalWarning from "../UI/ModalWarning";

export default {
  name: "SyllabusFilesPub",
  props: ['files', 'syllabusID'],
  components: {ModalWarning},
  data() {
    return {
      syllabusFile: null,
      fileList: null
    }
  },
  methods: {},
  async created() {

    this.syllabusFile = this.files.filter((el) => el.colName === 'pdf_f')[0]

    if (this.syllabusFile) {
      this.fileList = this.files.map((el) => {

        let title, files

        switch (el.colName) {
          case 'competencies_f':
            title = 'Компетенция'
            break
          case 'practice_f':
            title = 'Практика'
            break
          default:
            title = el.title
            break
        }
        console.log(el)
        if (!el.arFiles || el.arFiles.length === 0) {

          files = [{}, {}]
          files[0].name = `${title}.pdf`
          files[0].path = this.syllabusFile.arFiles[0].path

          if (files[1].name && files[1].path) {
            files[1].name = `${title}.pdf.sig`
            files[1].path = this.syllabusFile.arFiles[1].path
          }

        } else {
          files = [...el.arFiles]
        }

        return {
          ...el,
          arFiles: files,
          title: title
        }

      })
    }


  }
}
</script>

<style scoped>
label {
  width: 100%;
}

a {
  text-decoration: none;
}

a:hover {
  color: #0d6efd;
}

.cross {
  color: #b90e0a;
  cursor: pointer;
}
</style>
