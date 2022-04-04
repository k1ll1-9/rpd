<template>
  <router-view/>
</template>
<script>

export default {
  name: 'App',
  components: {},
  props: {
    templatePath: String
  },
  computed: {},
  async mounted() {
    const url = (process.env.NODE_ENV === 'development') ? process.env.VUE_APP_API_PROXY : `https://lk.vavt.ru${this.templatePath}/api/index.php`
    this.$store.commit('SET_API_URL',url)
  }
}
</script>

<style>
@font-face {
  font-family: "PT Sans";
  src: local("PT Sans"),
  url("./assets/fonts/PT-Sans/PTSans-Regular.ttf") format("truetype");
}

#app {
  margin-top: 60px;
  width: 1200px;
}

h3, h2 {
  font-weight: 600 !important;
  text-align: center;
}

* {
  font-family: 'PT Sans', sans-serif;
}

td, th {
  text-align: center;
}
</style>
