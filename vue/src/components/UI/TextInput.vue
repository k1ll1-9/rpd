<template>
  <input class="form-control"
         type="text"
         :value="value"
         @change="updateState">
</template>

<script>

export default {
  name: "TextInput",
  props: ['identity'],
  data() {
    return {
    }
  },
  methods: {
    updateState(e) {
      this.$store.dispatch('rpd/updateData', {identity: this.identity, value: e.target.value , updateType: 'UPDATE_RPD_ITEM'});
    }
  },
  computed: {
    value() {
      return this.identity.reduce((acc, c) => acc && acc[c], this.$store.state.rpd)
    }
  }

}
</script>

<style scoped>

</style>
