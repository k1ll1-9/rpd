<template>
  <div class="container-fluid">
    <div class="d-flex align-items-center justify-content-center">
      <a class="btn btn-primary mb-5 btn-lg" href="https://lk.vavt.ru/doc/rpd/">Активные согласования</a>
      <router-link
        class="btn btn-primary mb-5 btn-lg ms-5"
        to="/stat?type=plans">
        Статистика
      </router-link>
    </div>
    <h2 class="my-2">Список учебных планов</h2>
    <table v-if="syllabuses" class="table my-5">
      <thead>
      <tr>
        <th>Уровень подготовки</th>
        <th>Форма обучения</th>
        <th>Направление</th>
        <th>Профиль</th>
        <th>Дата начала обучения</th>
        <th v-if="canDelete"></th>
      </tr>
      </thead>
      <tbody>
      <template v-for="(syllabusGroup, groupName) in syllabuses" :key="groupName">
        <tr v-for="(syllabus, index) in syllabusGroup" :key="index">
          <template v-if="index === 0">
            <td :rowspan="syllabusGroup.length">{{ syllabus.qualification }}</td>
            <td :rowspan="syllabusGroup.length">{{ syllabus.education_form }}</td>
            <td :rowspan="syllabusGroup.length">{{ syllabus.special }}</td>
            <td :rowspan="syllabusGroup.length">{{ syllabus.profile }}</td>
          </template>
          <td>
            <router-link :to="{path : '/list', query : syllabus.query}" class="btn btn-primary">
              {{ syllabus.entrance_year }}
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
      </template>
      </tbody>
    </table>
    <Preloader v-else style="margin-top: 200px"/>
    <ModalWarning id="deleteSyllabus" @confirm="deleteSyllabus()">
      <template v-slot:title>
        Удаление учебного плана
      </template>
      <template v-if="currentSyllabus" v-slot:body>
        Вы действительно хотите удалить учебный план <br>
        <strong>{{
            `"${currentSyllabus.special} ${currentSyllabus.profile}  ${(new Date(currentSyllabus.syllabus_year)).getFullYear()}"`
          }}</strong>?
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
      syllabuses: false,
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

    this.syllabuses = res.data
      .map((el) => {
        return {
          ...el,
          entrance_year: this.$dayjs((new Date(el.entrance_year.replace(/-/g, "/")))).format('DD.MM.YYYY'),
          query: {
            id: el.id
          }
        }
      })
      .reduce((acc, c) => {
        const key = `${c.special}_${c.profile}_${c.qualification}_${c.education_form}`

        acc[key] = acc[key] ?? []
        acc[key].push(c)

        return acc
      }, {})

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
