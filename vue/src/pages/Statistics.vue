<template>
  <div class="container-fluid">
    <div class="d-flex align-items-center justify-content-center">
      <router-link
        class="btn btn-primary mb-5 btn-lg ms-5"
        to="/">
        Список Учебных Планов
      </router-link>
      <router-link
        class="btn btn-primary mb-5 btn-lg ms-5"
        to="/stat?type=plans">
        Статистика
      </router-link>
      <button
        class="btn btn-primary mb-5 btn-lg ms-5"
        @click="downloadXLSX"
      >
        Скачать xlsx файл
      </button>
    </div>
    <h2 class="my-2">Учебные планы</h2>
    <table v-if="syllabuses" class="table my-5" id="stat">
      <thead>
      <tr>
        <th>Уровень подготовки</th>
        <th>Форма обучения</th>
        <th>Направление</th>
        <th>Профиль</th>
        <th>Дата начала обучения</th>
        <th>Заполнено</th>
        <th>На согласовании</th>
        <th>Согласовано</th>
        <th>Загружено на сайт</th>
        <th>Всего</th>
      </tr>
      </thead>
      <tbody>
      <template v-for="(syllabusGroup, groupName) in syllabuses" :key="groupName">
        <tr v-for="(syllabus, index, i) in syllabusGroup" :key="index">
          <template v-if="i === 0">
            <td :rowspan="Object.keys(syllabusGroup).length">{{ syllabus.educationLevel }}</td>
            <td :rowspan="Object.keys(syllabusGroup).length">{{ syllabus.formOfTraining }}</td>
            <td :rowspan="Object.keys(syllabusGroup).length">{{ syllabus.special }}</td>
            <td :rowspan="Object.keys(syllabusGroup).length">{{ syllabus.profile }}</td>
          </template>
          <td>
            <router-link :to="{path : '/list', query : syllabus.query}" class="btn btn-primary">
              {{ syllabus.year }}
            </router-link>
          </td>
          <td>{{ syllabus.valid }}</td>
          <td>{{ syllabus.inProcess }}</td>
          <td>{{ syllabus.approved }}</td>
          <td>{{ syllabus.uploaded }}</td>
          <td>{{ syllabus.total }}</td>
        </tr>
      </template>
      </tbody>
    </table>
    <Preloader v-else style="margin-top: 200px"/>

  </div>
</template>

<script>
import Preloader from "../components/Misc/Preloader";
import {utils, writeFileXLSX} from 'xlsx';

export default {
  name: "Statistics",
  components: {
    Preloader,
  },
  data() {
    return {
      syllabuses: null,
      wb: null
    }
  },
  async created() {
    await this.$store.dispatch('syllabuses/getStats')

    this.syllabuses = this.$store.state.syllabuses.stats
      .map((el) => {

        const syllabusDate = JSON.parse(el.json).syllabusData.year
        return {
          ...el,
          year: this.$dayjs((new Date(syllabusDate))).format('DD.MM.YYYY'),
        }
      })
      .reduce((acc, c) => {

        const syllabus = JSON.parse(c.json).syllabusData
        const key = `${syllabus.special}_${syllabus.profile}_${syllabus.educationLevel}_${syllabus.formOfTraining}`
        const year = c.year

        acc[key] = acc[key] ?? []
        acc[key][year] = acc[key][year] ?? []
        acc[key][year].push(c)

        return acc
      }, {})

    this.syllabuses = Object.fromEntries(Object.entries(this.syllabuses).map(([name, group]) => {

        const syllabuses = {}

        Object.entries(group).forEach(([year, sb]) => {

          let valid = 0
          let approved = 0
          let inProcess = 0
          let uploaded = 0

          sb.forEach((disc) => {
            console.log(disc.approved)
            if (disc.valid === 'valid') {
              valid++
            }

            if (disc.approval === 'approved') {
              approved++
            }

            if (disc.approval === 'inProcess') {
              inProcess++
            }

            if (disc.rpd_f !== null) {
              uploaded++
            }

          })

          syllabuses[year] = {
            ...JSON.parse(sb[0].json).syllabusData,
            year: sb[0].year,
            total: sb.length,
            inProcess: inProcess,
            approved: approved,
            uploaded: uploaded,
            valid: valid,
            query: {
              id: JSON.parse(sb[0].json).syllabusData.syllabusID
            },
          }
        })

        return [name, syllabuses]

      })
    )

    this.$nextTick(function () {
      this.wb = utils.table_to_book(document.getElementById('stat'))
    })

  },
  methods: {
    downloadXLSX() {
      writeFileXLSX(this.wb, 'RPD_statistics_' + this.$dayjs((new Date())).format('DD.MM.YYYY') + '.xlsx');
    }
  }
}
</script>

<style scoped>
td, th {
  vertical-align: middle;
}
</style>
