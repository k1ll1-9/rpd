<template>
  <div class="container-fluid">
    <h2 class="my-2">Список учебных планов</h2>
    <table class="table my-5" v-if="syllabuses">
      <thead>
      <tr>
        <th>Уровень подготовки</th>
        <th>Направление</th>
        <th>Профиль</th>
        <th>Год</th>
        <th>Список дисциплин</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(syllabus, index) in syllabuses" :key="index">
        <td>{{ syllabus.qualification }}</td>
        <td>{{ syllabus.special }}</td>
        <td>{{ syllabus.profile }}</td>
        <td>{{ syllabus.entrance_year }}</td>
        <td>
          <router-link :to="{path : '/list', query : syllabus.query}" class="btn btn-primary">
            К списку
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

export default {
  name: "SyllabusesList",
  components: {
    Preloader
  },
  data() {
    return {
      syllabuses: null,
    }
  },
  async mounted() {
    const res = await this.axios.get(this.$store.state.APIurl,
        {
          params: {
            action: "getSyllabusesList",
          }
        });

    this.syllabuses = res.data.map((el) => {
      return {
        ...el,
        entrance_year : (new Date(el.entrance_year)).getFullYear(),
        query : {
          special: el.special,
          profile: el.profile,
          year: el.entrance_year
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
