<template>
  <select class="form-select text-center" @change="updateState" >
    <option v-if="value === null" disabled selected value></option>
    <option v-for="(option,index) in options"
            :selected="option.toString() === value"
            :value="option"
            :key="index">
      {{ option }}
    </option>
  </select>
</template>

<script>

export default {
  name: "Select",
  props: ['identity', 'options'],
  data() {
    return {
      lastValid: null
    }
  },
  methods: {
    updateState(e) {
      this.$store.dispatch('updateData', {
        identity: this.identity,
        value: e.target.value,
        updateType: 'UPDATE_RPD_ITEM'
      });
    },
  },
  computed: {
    value() {
      return this.identity.reduce((acc, c) => acc && acc[c], this.$store.state)
    }
  }

}
</script>

<style scoped>

</style>
