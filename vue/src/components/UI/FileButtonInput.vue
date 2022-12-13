<template>
  <label :class="[buttonClass || 'btn btn-primary',{disabled : options.disabled}]">{{ label }}
    <input type="file" @change="upload" hidden>
  </label>
  <ModalWarning :id="id" passive="true">
    <template v-slot:title>
      Ошибка загрузки файла
    </template>
    <template v-slot:body>
      {{  errorMessage }}
    </template>
  </ModalWarning>
</template>

<script>
import ModalWarning from "@/components/UI/ModalWarning";
import {Modal} from "bootstrap";

export default {
  name: "FileButtonInput",
  components: { ModalWarning},
  props: ['options', 'label','disabled','allowedTypes','errorMessage','buttonClass','id'],
  methods: {
    async upload(e) {

      if (this.allowedTypes !== undefined){

        const split = e.target.files[0].name.split('.')
        const ext = split[split.length -1]

        if (!this.allowedTypes.includes(ext)){

          const modal = new Modal(document.getElementById(this.id))

          modal.show()

          return false
        }

      }

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
