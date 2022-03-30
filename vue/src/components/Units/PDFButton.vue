<template>
  <button v-if="!PDFLink && !loading"  class="btn btn-lg btn-primary mb-4" @click="getPDF()">
    Сгенерировать PDF
  </button>
  <Preloader v-else-if="loading"/>
  <a v-else :href="PDFLink" class="btn btn-success btn-lg mb-4" target="_blank">Перейти к PDF</a>
</template>

<script>
import Preloader from "../../components/Misc/Preloader";

export default {
  components: {Preloader},
  name: "PDFButton",
  data() {
    return {
      PDFLink: null,
      loading: false,
    }
  },
  methods: {
    async getPDF() {
      this.loading = true
      this.PDFLink = await this.$store.dispatch('initPDF')
      this.loading = false
    }
  }
}
</script>

<style scoped>

</style>
