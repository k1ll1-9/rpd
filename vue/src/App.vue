<template>
  <router-view/>
</template>
<script>

import {mapActions, mapMutations, mapState} from "vuex";

export default {
  name: 'App',
  components: {},
  props: {
    templatePath: String
  },
  data() {
    return {
      ready: false,
    }
  },
  computed: {
    ...mapState({
      unitTitles: state => state.rpd.static.unitTitles
    })
  },
  methods: {
    ...mapMutations({
      SET_API_URL: 'rpd/SET_API_URL',
      SET_PARAMS: 'rpd/SET_PARAMS'
    }),
    ...mapActions({
      initData: 'rpd/initData'
    })
  },
  async mounted() {
    const url = (process.env.NODE_ENV === 'development') ? process.env.VUE_APP_API_PROXY : `https://lk.vavt.ru/${this.templatePath}/api/index.php`

    await this.SET_API_URL(url)
    await this.initData()
    this.ready = true
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
