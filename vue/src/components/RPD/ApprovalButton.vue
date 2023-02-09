<template>
  <div class="ms-5" v-if="!loading">
    <button :class="[{'disabled': disabled},'btn btn-lg btn-primary mb-4']" @click="requestApprove()">
      Отправить на согласование
    </button>
  </div>
  <div v-else class="ms-5">
    <Preloader/>
    <p class="fw-bold fs-5">Ожидайте перенаправления на страницу согласования!</p>
  </div>
  <div class="ms-5">
    <button :class="[{'disabled': !canRecall},'btn btn-lg btn-primary mb-4']" @click="disapprove()">
      Отозвать
    </button>
  </div>
</template>

<script>
import Preloader from "@/components/Misc/Preloader.vue";

export default {
  props: ['disabled', 'canRecall','approvalType'],
  name: "ApprovalButton",
  components: {Preloader},
  data() {
    return {
      visible: false,
      loading: false,
      external: this.$route.query?.external === 'true'
    }
  },
  methods: {
    async requestApprove() {
      this.loading = true
      const action = (this.external) ? 'approvalExternal' : 'approval'
      const approvalURL = (this.approvalType === 'self') ? '/doc/rpd/rpd.php?perm=' : '/doc/rpd/rpdext.php?perm='
      const PDFLink = await this.$store.dispatch('rpd/initPDF', action)

      const data = {
        link: PDFLink,
        BXID: this.$store.state.user.ID,
        UniID: this.$store.state.user.uniID,
        disciplineCode: this.$store.state.rpd.static.code,
        disciplineName: this.$store.state.rpd.static.name,
        educationLevel: this.$store.state.rpd.static.syllabusData.educationLevel,
        formOfTraining: this.$store.state.rpd.static.syllabusData.formOfTraining,
        syllabusYear: this.$store.state.rpd.static.syllabusData.syllabusYear,
        profile: this.$store.state.rpd.static.syllabusData.profile,
        special: this.$store.state.rpd.static.syllabusData.special,
        kafedra: this.$store.state.rpd.static.kafedra,
        syllabusID: this.$store.state.rpd.static.syllabusData.syllabusID
      }

      if (PDFLink) {

        if (this.external) {
          await this.$store.dispatch('rpd/setStatus', {
            statusName: 'status',
            status: 'valid'
          })
        }

        const res = await this.$store.dispatch('rpd/setStatus', {
          statusName: 'approval',
          status: 'inProcess'
        })

        if (res.success) {
          window.location.replace(approvalURL + btoa(encodeURIComponent(JSON.stringify(data))))
        }

      }

    },
    async disapprove() {
      await this.$store.dispatch('rpd/setStatus', {
        statusName: 'approval',
        status: null
      })

      this.$store.commit('rpd/UNLOCK_RPD')
    }
  },
  async mounted() {
  }
}
</script>

<style scoped>
.btn {
  width: 275px;
}
</style>
