<template>
  <div class="row mt-5">
    <div v-for="(file,index) in files" :key="index" class="col-3" style="min-height: 100px">
      <FileButtonInput
          @uploaded="pushFileList($event,index)"
          :label="file.title"
          :options="{action: 'uploadSyllabusFile', params : {...syllabus, colName : file.colName}}"/>
      <div v-for="(link,i) in file.arFiles" :key="i" class="my-2">
        <a :href="'https://lk.vavt.ru/helpers/getFile.php?file64='+encodeURIComponent(link.path)" target="_blank">
          {{ link.name }} </a>
      </div>
    </div>
  </div>
</template>

<script>
import FileButtonInput from "@/components/UI/FileButtonInput";

export default {
  name: "SyllabusFiles",
  props: ['files', 'syllabus'],
  components: {FileButtonInput},
  data() {
    return {
      filesList: this.files
    }
  },
  methods: {
    pushFileList(e, index) {
      this.filesList.map((el, i) => (i === index) ? el.arFiles?.push(e) || (el.arFiles = []).push(e) : el)
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
</style>
