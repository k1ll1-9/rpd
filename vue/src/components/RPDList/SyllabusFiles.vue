<template>
  <div class="row mt-5">
    <div v-for="(file,index) in files" :key="index" class="col-3 mb-2">
      <FileButtonInput
          @uploaded="pushFileList($event,index)"
          :label="(file?.arFiles?.length > 0 ? 'Добавить ' : 'Загрузить ') + file.title"
          :options="{action: 'uploadSyllabusFile', params : {id:syllabusID, colName : file.colName} ,disabled: !isEditor}"/>
      <div v-for="(link,i) in file.arFiles" :key="i" class="my-2">
        <a :href="'https://lk.vavt.ru/helpers/getFile.php?file64='+encodeURIComponent(link.path)" target="_blank">
          {{ link.name }}
        </a>
        <BIconX-octagon v-if="isEditor"
                        class="cross ms-1"
                        @click="removeFile(syllabus,link,i)"/>
      </div>
    </div>
  </div>
</template>

<script>
import FileButtonInput from "@/components/UI/FileButtonInput";

export default {
  name: "SyllabusFiles",
  props: ['files', 'syllabusID'],
  components: {FileButtonInput},
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
      this.filesList.map((el, i) => (i === index) ? el.arFiles?.push(e) || (el.arFiles = []).push(e) : el)
    },
    async removeFile(syllabus, link, index) {

      const exp = link.path.split('/')
      const colName = exp[exp.length - 2]
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
            console.log(el)
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
