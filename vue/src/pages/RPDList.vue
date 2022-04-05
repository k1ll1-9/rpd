<template>
  <div class="container-fluid">
    <h2 class="my-2">Учебный план</h2>
    <h2 class="my-4">{{ $route.query.special }} - {{ $route.query.profile }} -
      {{ (new Date($route.query.year)).getFullYear() }}</h2>
    <SyllabusFiles/>
    <table class="table my-5" v-if="RPDList">
      <thead>
      <tr>
        <th>№</th>
        <th>Код</th>
        <th>Дисциплина</th>
        <th>Кафедра</th>
        <th>РПД</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(rpd, index) in RPDList" :key="index">
        <td>{{ index + 1 }}</td>
        <td>{{ rpd.disciplineIndex }}</td>
        <td>{{ rpd.name }}</td>
        <td>{{ rpd.kafedra }}</td>
        <td>
          <router-link :to="{path : '/rpd', query : rpd.query}" class="btn btn-primary"
                       :class="{disabled: !rpd.editable}">
            Редактировать РПД
          </router-link>
        </td>
      </tr>
      </tbody>
    </table>
    <Preloader v-else style="margin-top: 200px"/>
  </div>
</template>

<script>
import Preloader from "../components/Misc/Preloader";
import SyllabusFiles from "@/components/RPDList/SyllabusFiles";

export default {
  name: "SyllabusesList",
  components: {
    Preloader,
    SyllabusFiles
  },
  data() {
    return {
      RPDList: null,
    }
  },
  async mounted() {
    const res = await this.axios.get(this.$store.state.APIurl,
        {
          params: {
            action: "getRPDList",
            params: this.$route.query
          }
        });

    this.RPDList = res.data.map((el) => {
      const json = JSON.parse(el.json)
      return {
        ...json,
        editable: this.$store.state.user.departmentString.includes(json.kafedra) || this.$store.state.user.role === 'admin',
        query: {
          special: json.syllabusData.special,
          profile: json.syllabusData.profile,
          year: json.syllabusData.year,
          name: json.name
        }
      }
    })
  }
}
</script>

<style scoped>
td {
  vertical-align: middle;
}
</style>

