<template>
  <div class="container-fluid">
    <div class="d-flex align-items-center justify-content-center">
      <button
        class="btn btn-primary btn-lg"
        @click="downloadXLSX"
      >
        Скачать xlsx файл
      </button>
    </div>
    <table v-if="syllabuses" class="table my-5" id="stat">
      <thead>
      <tr>
        <th>Кафедра</th>
        <th>Всего</th>
        <th>Заполнено</th>
        <th>На согласовании</th>
        <th>Согласовано</th>
        <th>Загружено на сайт</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(kafedra, name) in syllabuses" :key="name">
        <td class="text-start">
          <router-link
            :to="{
            path : '/list',
            query : {
              type: 'kafs',
              name: name
            }
          }"
            class="btn btn-primary"
          >
            {{ name }}
          </router-link>
        </td>
        <td>{{ kafedra.total }}</td>
        <td>{{ kafedra.valid }}</td>
        <td>{{ kafedra.inProcess }}</td>
        <td>{{ kafedra.approved }}</td>
        <td>{{ kafedra.uploaded }}</td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import {utils, writeFileXLSX} from 'xlsx';

export default {
  name: "Statistics",
  props: ['syllabusesRaw'],
  components: {},
  data() {
    return {
      syllabuses: null,
      wb: null
    }
  },
  async mounted() {

    if (this.syllabusesRaw !== null) {

      this.syllabuses = this.syllabusesRaw
        .reduce((acc, c) => {

          const key = c.kafedra

          acc[key] = acc[key] ?? []
          acc[key].push(c)

          return acc
        }, {})

      this.syllabuses = Object.fromEntries(Object.entries(this.syllabuses).map(([name, kaf]) => {

          let valid = 0
          let approved = 0
          let inProcess = 0
          let uploaded = 0

          kaf.forEach((disc) => {

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

          return [
            name,
            {
              total: kaf.length,
              inProcess: inProcess,
              approved: approved,
              uploaded: uploaded,
              valid: valid,
            }
          ]

        })
      )

      this.$nextTick(function () {
        this.wb = utils.table_to_book(document.getElementById('stat'))
      })

    }

  },
  methods: {
    downloadXLSX() {
      writeFileXLSX(this.wb, 'RPD_statistics_kafs_' + this.$dayjs((new Date())).format('DD.MM.YYYY') + '.xlsx');
    }
  }
}
</script>

<style scoped>
td, th {
  vertical-align: middle;
}
</style>
