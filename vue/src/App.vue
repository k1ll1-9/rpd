<template>
  <div v-if="data !== null">
    <EntryBlock :key="title" :title="title"/>
    <DiscStructure :discStructure="data.discStructure"
                   @deleteRow="deleteRow"
                   @addRow="addRow"
                   @updateField="updateField($event)/*,saveFiled($event)*/"
    />
  </div>
</template>
<script>

import DiscStructure from './components/DiscStructure.vue'
import EntryBlock from "./components/EntryBlock";

export default {
  name: 'App',
  components: {
    EntryBlock,
    DiscStructure
  },
  props: {
    templatePath: String
  },
  data() {
    return {
      testVal: 'test',
      title: '',
      APIurl: (process.env.NODE_ENV === 'development') ? process.env.VUE_APP_API_PROXY : `https://lk.vavt.ru/${this.templatePath}/api/index.php`,
      data: null
    }
  },
  methods: {
    updateField(e) {
      for (let unit in e){
        const index = e[unit].index;
        const name = e[unit].name;

        this.data[unit][index][name] = e[unit].value;
      }
    },
/*    async saveFiled(e) {
      const res = await this.axios.post(this.APIurl,
          {
            action: "setData",
            data: e
          });

      console.log(res.data)
    },*/
    deleteRow(e) {
      this.data[e.unit].splice([e.index], 1);
    },
    addRow(e) {
      this.data[e.unit].push(e.row);
    }
  },
  async mounted() {
    const res = await this.axios.get(this.APIurl,
        {
          params: {
            action: "getData"
          }
        });

    this.data = res.data
  }
}
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;

  margin-top: 60px;
  width: 1200px;
}

a:hover {
  color: #ffffff !important;
  text-decoration: none !important;
  background-color: transparent !important;
}
</style>
