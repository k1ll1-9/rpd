<template>
  <EntryBlock :key="title" :title="title" />
  <DiscContent :key="discContent" :contents="discContent"/>
</template>
<script>

import DiscContent from './components/DiscContent.vue'
import EntryBlock from "./components/EntryBlock";

export default {
  name: 'App',
  components: {
    EntryBlock,
    DiscContent
  },
  data() {
    return {
      title: '',
      discContent: {},
    }
  },
  beforeCreate() {
    this.axios.get('https://lk.vavt.ru/rpd/api/index.php?action=getData')
        .then((response) => {
          this.title = response.data.upName
          this.discContent = response.data.discContent
        });
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
