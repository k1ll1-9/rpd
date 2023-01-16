<template>
  <label :class="[buttonClass || 'btn btn-primary w-100',{disabled : options.disabled}]">{{ label }}
    <input type="file" @change="upload" hidden>
  </label>
  <div v-if="link" class="d-flex flex-flow justify-content-between">
    <a :href="link"
       target="_blank"
       class="btn btn-success w-100 me-1"
       :class="{disabled : options.disabled}"
    >
      Скачать
    </a>
    <button
      v-if="options.deleteAction"
      class="btn btn-danger w-100 ms-1"
      :class="{disabled : options.disabled}"
      @click="deleteFile"
    >
      Удалить
    </button>
  </div>
  <ModalWarning :id="id" passive="true">
    <template v-slot:title>
      Ошибка загрузки файла
    </template>
    <template v-slot:body>
      {{ errorMessage }}
    </template>
  </ModalWarning>
</template>

<script>
import ModalWarning from "@/components/UI/ModalWarning.vue";
import {Modal} from "bootstrap";

export default {
  name: "FileButtonInput",
  emits: ["uploaded"],
  components: {ModalWarning},
  props: ['options', 'label', 'disabled', 'allowedTypes', 'errorMessage', 'buttonClass', 'id', 'name'],
  data() {
    return {
      link: null
    }
  },
  methods: {
    async upload(e) {

      if (this.allowedTypes !== undefined) {

        const split = e.target.files[0].name.split('.')
        const ext = split[split.length - 1]

        if (!this.allowedTypes.includes(ext)) {

          const modal = new Modal(document.getElementById(this.id))

          modal.show()

          return false
        }

      }

      const formData = new FormData();

      formData.append('file', e.target.files[0]);
      formData.append('action', this.options.addAction);
      formData.append('params', JSON.stringify(this.options.params));

      const res = await this.axios.post(this.$store.state.APIurl,
        formData,
        {
          headers: {
            'Content-Type': 'multipart/form-data'
          }
        }
      )

      if (this.name !== undefined) {
        this.link = res.data.link
      }

      this.$emit('uploaded', res.data)
    },
    async deleteFile() {
      const res = await this.axios.post(this.$store.state.APIurl,
        {
          action: this.options.deleteAction,
          params: this.options.params,
          name: this.name
        }
      )
      if (res.data.success === true) {
        this.link = null
      }
    }
  },
  async created() {
    if (this.name !== undefined) {
      const res = await this.axios.get(this.$store.state.APIurl,
        {
          params: {
            action: "checkRPDFile",
            params: this.options.params,
            name: this.name
          }
        });
      this.link = res.data.link
    }
  }
}
</script>

<style scoped>

</style>
