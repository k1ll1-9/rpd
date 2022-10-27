<template>
  <div>
  <button v-if="!PDFLink && !loading"  class="btn btn-lg btn-primary mb-4" @click="requestApprove()">
    Отправить на согласование
  </button>
  <Preloader v-else-if="loading"/>
  <p v-else>{{data}}</p>
  </div>
</template>

<script>
import Preloader from "../Misc/Preloader";

export default {
  components: {Preloader},
  name: "ApprovalButton",
  data() {
    return {
      PDFLink: null,
      loading: false,
      data: ''
    }
  },
  methods: {
    async requestApprove() {
      this.loading = true
      this.PDFLink = await this.$store.dispatch('rpd/initPDF')

      const data = {
        link: this.PDFLink,
        BXID: this.$store.state.user.ID,
        UniID: this.$store.state.user.uniID,
        disciplineCode: this.$store.state.rpd.static.code,
        disciplineName: this.$store.state.rpd.static.name,
        kafedra: this.$store.state.rpd.static.kafedra,
        syllabusID: this.$store.state.rpd.static.syllabusData.syllabusID
      }

      console.log(data);

      this.data = JSON.stringify(data)
      this.loading = false
    }
  }
}
</script>

<style scoped>

</style>
