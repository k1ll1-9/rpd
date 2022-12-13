<template>
  <div class="ms-5">
  <button :class="[{'disabled': disabled},'btn btn-lg btn-primary mb-4']" @click="requestApprove()">
    Отправить на согласование
  </button>
  </div>
  <div v-if="visible" class="ms-5">
    <button class="btn btn-lg btn-primary mb-4" @click="disapprove()">
      Отозвать
    </button>
  </div>
</template>

<script>

export default {
  props: ['disabled'],
  name: "ApprovalButton",
  data() {
    return {
      visible: false
    }
  },
  methods: {
    async requestApprove() {
      this.loading = true
      const PDFLink = await this.$store.dispatch('rpd/initPDF','approval')

      const data = {
        link: PDFLink,
        BXID: this.$store.state.user.ID,
        UniID: this.$store.state.user.uniID,
        disciplineCode: this.$store.state.rpd.static.code,
        disciplineName: this.$store.state.rpd.static.name,
        educationLevel: this.$store.state.rpd.static.syllabusData.educationLevel,
        profile: this.$store.state.rpd.static.syllabusData.profile,
        special: this.$store.state.rpd.static.syllabusData.special,
        kafedra: this.$store.state.rpd.static.kafedra,
        syllabusID: this.$store.state.rpd.static.syllabusData.syllabusID
      }

      if (PDFLink){

        const res = await this.$store.dispatch('rpd/setStatus', {
          statusName: 'approval',
          status: 'inProcess'
        })

        if (res.success){
          window.location.replace('/doc/rpd/rpd.php?perm=' + btoa(encodeURIComponent(JSON.stringify(data))))
        }

      }

    },
    async disapprove(){
      await this.$store.dispatch('rpd/setStatus', {
        statusName: 'approval',
        status: null
      })
    }
  },
  mounted() {
    this.visible = this.$store.state.user?.role === 'admin' || process.env.NODE_ENV === 'development'
  }
}
</script>

<style scoped>
.btn{
  width: 275px;
}
</style>
