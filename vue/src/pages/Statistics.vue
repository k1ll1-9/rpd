<template>
  <template v-if="syllabuses">
    <div class="container-fluid">
      <StatisticsPlans
        v-if="$route.query.type=== 'plans'"
        :syllabusesRaw="syllabuses"
      />
    </div>
    <div class="container-fluid">
      <StatisticsKafs
        v-if="$route.query.type=== 'kafs'"
        :syllabusesRaw="syllabuses"
      />
    </div>
  </template>
  <Preloader v-else style="margin-top: 200px"/>
</template>

<script>
import StatisticsPlans from "@/components/Statistics/StatisticsPlans";
import StatisticsKafs from "@/components/Statistics/StatisticsKafs";
import Preloader from "@/components/Misc/Preloader";

export default {
  name: "Statistics",
  components: {
    StatisticsPlans,
    StatisticsKafs,
    Preloader
  },
  data() {
    return {
      syllabuses: null,
      wb: null
    }
  },
  async created() {

    if (this.$store.state.syllabuses.stats === undefined) {

      await this.$store.dispatch('syllabuses/getStats')
    }

    this.syllabuses = this.$store.state.syllabuses.stats
      .map((el) => {

        const syllabusDate = JSON.parse(el.json).syllabusData.year
        return {
          ...el,
          year: this.$dayjs((new Date(syllabusDate))).format('DD.MM.YYYY'),
        }
      })

  }
}
</script>

<style scoped>
td, th {
  vertical-align: middle;
}
</style>
