<template>
  <div class="container">
    <div class="wrapper d-flex ms-2">
      <div class="fw-bold">
        РПД содержит ошибки в следующих блоках:
      </div>
      <div class="arrow-wrapper ms-2 d-flex position-absolute justify-content-center" @click="toggle">
        <div class="open-text fw-bold">
          {{ opened ? 'Свернуть' : 'Развернуть' }}
        </div>
        <BIconArrowDownShort :class="[{opened: opened},'arrow-open']" />
      </div>
    </div>
    <div class="list-wrapper mt-2" v-if="opened">
      <ul>
        <li v-for="(item,index) in errors" :key="index">
          <a :href="`#${item.id}`">{{item.desc}}</a>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>

import {mapState} from "vuex";

export default {
  name: "NoticeWindow",
  data() {
    return {
      opened: false
    }
  },
  methods: {
    toggle(){
      this.opened = !this.opened
    }
  },
  computed: {
    ...mapState({
      errors: state => state.rpd.errors.sort((a,b) => a.order - b.order)
    })
  }
}
</script>

<style scoped>
.container {
  z-index: 102;
  padding: 15px;
  width: 500px;
  position: fixed;
  top: 30px;
  right: 100px;
  background-color: rgb(253, 253, 150, 0.9);
  border-radius: 5px;
  border: 1px solid rgba(218, 218, 117, 0.9);
  box-shadow: 0 0 2px #000000;
}
.arrow-open{
  width: 25px;
  height: 25px;
  transform: rotate(0deg);
  transition: all 0.5s ease;
}
.arrow-wrapper{
  right: 20px;
  top: 10px;
  border: 2px solid #656464;
  padding: 5px;
  border-radius: 5px;
  cursor: pointer;
  width: 115px;
}
.opened{
  transform: rotate(180deg);
  transition: all 0.5s ease;
}
.open-text{
  z-index: 100;
}
ul{
  margin-bottom: 5px;
}
li{
  text-align: left;
}
a:hover{
  text-decoration: underline;
}
a{
  color: #000000;
}
</style>
