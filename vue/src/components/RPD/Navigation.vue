<template>
  <div class="wrapper">
    <h2 class="my-4">Оглавление</h2>
    <ol class="w-75 m-auto">
      <li v-for="(item,code) in $store.state.rpd.static.unitTitles" :key="code" class="text-start my-1">
        <a :href="'#' + item.code" @click.prevent="scrollTo">{{ item.title }}</a>
        <ol v-if="item.subUnits">
          <li v-for="(subItem,subCode) in item.subUnits" :key="subCode" class="text-start my-1">
            <a :href="'#' + subItem.code" @click.prevent="scrollTo">{{ subItem.title }}</a>
          </li>
        </ol>
      </li>
    </ol>
    <div class="arrow-wrapper d-flex align-items-center justify-content-center" v-if="scY > 300" @click="toTop">
      <BIconArrowUp class="arrow-up"/>
    </div>
  </div>
</template>

<script>


export default {
  name: "Navigation",
  data() {
    return {
      scY: 0
    }
  },
  mounted() {
    window.addEventListener('scroll', () => this.scY = window.scrollY);
  },
  methods: {
    toTop: function () {
      window.scrollTo({
        top: 0,
        behavior: "smooth"
      });
    },
    scrollTo: function ($event) {

      const id = $event.target.getAttribute('href').substring(1)
      const elY = document.getElementById(id)?.getBoundingClientRect()?.top

      if (elY === undefined){
        return
      }

      window.scrollTo({
        top: elY,
        behavior: "smooth"
      });
    }
  }
}
</script>

<style scoped>
a:hover {
  text-decoration: underline;
}

a {
  color: #000000 !important;
}

ul {
  list-style: none;
}

h2 {
  font-weight: 600;
}

.wrapper {
  margin: 40px 0 100px;
}

.arrow-up {
  width: 30px;
  height: 30px;
  opacity: 0.7;
}

.arrow-wrapper {
  width: 60px;
  height: 60px;
  background: rgb(35, 120, 231, 0.6);
  border: 1px solid rgb(0, 0, 0, 0.5);
  background-clip: padding-box;
  border-radius: 100px;
  cursor: pointer;
  position: fixed;
  right: 130px;
  bottom: 50px;
  z-index: 102;
}
</style>
