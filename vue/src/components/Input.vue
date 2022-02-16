<template>
  <input class="form-control"
         :value="value"
         @blur="updateState">
</template>

<script>

export default {
  name: "Input",
  props: ['identity'],
  methods: {
    updateState(e){
      this.commit('UPDATE_STATE',{identity:this.identity, value: e.target.value})
    }
  },
    computed:{
      value() {
        return this.$store.state[this.identity[0]][this.identity[1]][this.identity[2]]
      }
}


}
</script>

<style scoped>

</style>
