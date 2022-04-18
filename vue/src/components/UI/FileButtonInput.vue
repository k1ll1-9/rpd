<template>
  <label class="btn btn-primary" :class="{disabled : options.disabled}">{{ label }}
    <input type="file" @change="upload" hidden>
  </label>
</template>

<script>
export default {
  name: "FileButtonInput",
  props: ['options', 'label','disabled'],
  methods: {
    async upload(e) {
      const formData = new FormData();

      formData.append('file', e.target.files[0]);
      formData.append('action', this.options.action);
      formData.append('params', JSON.stringify(this.options.params));

      const res = await this.axios.post( this.$store.state.APIurl,
          formData,
          {
            headers: {
              'Content-Type': 'multipart/form-data'
            }
          }
      )
      this.$emit('uploaded',res.data)
    }
  }
}
</script>

<style scoped>

</style>
