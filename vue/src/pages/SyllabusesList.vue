<template>
  <div class="container-fluid">
    <h2 class="my-2">Список учебных планов</h2>
    <table v-if="syllabuses" class="table my-5">
      <thead>
      <tr>
        <th>Уровень подготовки</th>
        <th>Форма обучения</th>
        <th>Направление</th>
        <th>Профиль</th>
        <th>Дата начала обучения</th>
        <th>Список дисциплин</th>
        <th v-if="canDelete"></th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(syllabus, index) in syllabuses" :key="index">
        <td>{{ syllabus.qualification }}</td>
        <td>{{ syllabus.education_form }}</td>
        <td>{{ syllabus.special }}</td>
        <td>{{ syllabus.profile }}</td>
        <td>{{ syllabus.entrance_year }}</td>
        <td>
          <router-link :to="{path : '/list', query : syllabus.query}" class="btn btn-primary">
            К списку
          </router-link>
        </td>
        <td v-if="canDelete">
          <button class="btn btn-danger"
                  data-bs-toggle="modal"
                  data-bs-target="#deleteSyllabus"
                  @click="currentSyllabus = syllabus"
                  >
            Удалить
          </button>
        </td>
      </tr>
      </tbody>
    </table>
    <Preloader v-else style="margin-top: 200px"/>
    <ModalWarning id="deleteSyllabus" @confirm="deleteSyllabus()">
      <template v-slot:title>
        Удаление учебного плана
      </template>
      <template v-if="currentSyllabus" v-slot:body>
        Вы действительно хотите удалить учебный план <br>
        <strong>{{ `"${currentSyllabus.special} ${currentSyllabus.profile}  ${(new Date(currentSyllabus.syllabus_year)).getFullYear()}"` }}</strong>?
      </template>
    </ModalWarning>
  </div>
</template>

<script>
import Preloader from "../components/Misc/Preloader";
import ModalWarning from "@/components/UI/ModalWarning";

export default {
  name: "SyllabusesList",
  components: {
    Preloader,
    ModalWarning
  },
  data() {
    return {
      syllabuses: null,
      currentSyllabus: null,
      canDelete: null
    }
  },
  methods: {
    async deleteSyllabus() {

      const res = await this.axios.post(this.$store.state.APIurl,
          {
            action: "deleteSyllabus",
            params: {
              ID: this.currentSyllabus.id,
            }
          });

      if (res.data.success === true) {
        this.syllabuses = this.syllabuses.filter(el => el.id !== this.currentSyllabus.id)
        this.currentSyllabus = null
      }
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
        entrance_year: this.$dayjs((new Date(el.entrance_year.replace(/-/g, "/")))).format('DD.MM.YYYY'),
        query: {
          id: el.id
        }
      }
    })

    this.canDelete = this.$store.state.user.role === 'admin'
        || this.$store.state.user.role === 'editor'
        || process.env.NODE_ENV === 'development'

  }
}
</script>

<style scoped>
td {
  vertical-align: middle;
}
</style>
