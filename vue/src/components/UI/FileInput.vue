<template>
  <label class="btn btn-primary">Загрузить PDF
    <input type="file" @change="upload" hidden>
  </label>
</template>

<script>
export default {
  name: "FileInput",
  methods: {
    async upload(e) {
      const formData = new FormData();

      formData.append('file', e.target.files[0]);
      formData.append('action', 'uploadFile');

      const res = await this.axios.post( this.$store.state.APIurl,
          formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          }
      )
      console.log(res)
    }
  }
}
</script>

<style scoped>

</style>
