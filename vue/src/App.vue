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
  data() {
    return {
      ready: false,
    }
  },
  computed: {},
  mounted() {
    this.ready = this.$store.dispatch('init')
  }

}
</script>

<style>
@font-face {
  font-family: "PT Sans";
  src: local("PT Sans"),
  url("./assets/fonts/PT-Sans/PTSans-Regular.ttf") format("truetype");
}
@font-face {
  font-family: "PT Sans";
  src: local("PT Sans"),
  url("./assets/fonts/PT-Sans/PTSans-Bold.ttf") format("truetype");
  font-weight: bold;
}
@font-face {
  font-family: "PT Sans";
  src: local("PT Sans"),
  url("./assets/fonts/PT-Sans/PTSans-Italic.ttf") format("truetype");
  font-style: italic;
}
#app {
  margin-top: 60px;
  width: 1400px;
}

h3, h2, h4 {
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
