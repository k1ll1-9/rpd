<template>
  <div class="row mt-5">
    <div v-for="(file,index) in files" :key="index" class="col-3 mb-2">
      <FileButtonInput
          @uploaded="pushFileList($event,index)"
          :label="(file?.arFiles?.length > 0 ? 'Добавить ' : 'Загрузить ') + file.titleAccusative"
          :options="{addAction: 'uploadSyllabusFile', params : {id:syllabusID, colName : file.colName} ,disabled: !isEditor}"/>
      <div v-for="(link,i) in file.arFiles" :key="i" class="my-2">
        <a :href="'https://lk.vavt.ru/helpers/getFile.php?fileSSL='+link.path" target="_blank">
          {{ link.name }}
        </a>
        <BIconX-octagon v-if="isEditor"
                        class="cross ms-1"
                        @click="removeFile(file?.colName,link,i)"/>
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
import FileButtonInput from "@/components/UI/FileInputs/FileButtonInput.vue";
import ModalWarning from "../UI/ModalWarning";
import {Modal} from "bootstrap";

export default {
  name: "SyllabusFiles",
  props: ['files', 'syllabusID'],
  components: {FileButtonInput, ModalWarning},
  data() {
    return {
      isEditor: this.$store.state.user.role === 'editor'
          || this.$store.state.user.role === 'admin'
          || process.env.NODE_ENV === 'development',
      filesList: this.files
    }
  },
  methods: {
    pushFileList(e, index) {
      console.log(e)
      if (e.error === undefined){
        this.filesList.map((el, i) => (i === index) ? el.arFiles?.push(e) || (el.arFiles = []).push(e) : el)
      } else if (e.error === 'WS'){

        const modal = new Modal(document.getElementById('uploadWarning'))

        modal.show()
      }
    },
    async removeFile(colName, link, index) {

      const res = await this.axios.post(this.$store.state.APIurl,
          {
            action: 'deleteSyllabusFile',
            params: {
              id: this.syllabusID,
              link: link.path,
              colName: colName,
            }
          }
      )

      if (res.data.success === true) {
        this.filesList.forEach((el) => {
          if (el.colName === colName) {
            el.arFiles = el.arFiles.filter((el, i) => i !== index)
          }
        })

      }
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
