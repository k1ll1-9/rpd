<template>
  <Navbar/>
  <div class="main-wrapper">
  <router-view :key="$route.fullPath" />
  </div>
</template>
<script>

import Navbar from "@/components/Navbar";

export default {
  name: 'App',
  components: {Navbar},
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
  width: 100%;
  min-height: 70vh;
}
.main-wrapper{
  margin: 20px 50px;
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
