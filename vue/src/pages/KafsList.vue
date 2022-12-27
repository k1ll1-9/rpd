<template>
  <div class="container-fluid">
    <div  v-if="list" class="d-flex justify-content-center flex-column align-items-center">
    <h2 class="my-2">Список кафедр</h2>
    <table class="table my-5 w-50">
      <tbody>
      <tr v-for="(kafedra, index) in list" :key="index">
        <td>
          <router-link
            :to="{
            path : '/list',
            query : {
              type: 'kafs',
              name: kafedra.kafedra
            }
          }"
            class="btn btn-primary"
          >
            {{ kafedra.kafedra }}
          </router-link>
        </td>
      </tr>
      </tbody>
    </table>
    </div>
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
      list: null
    }
  },
  methods: {},
  async mounted() {
    const res = await this.axios.get(this.$store.state.APIurl,
      {
        params: {
          action: "getKafsList",
        }
      });

    this.list = res.data


  }
}
</script>

<style scoped>
td {
  vertical-align: middle;
}
</style>
