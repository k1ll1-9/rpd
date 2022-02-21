<template>
  <textarea class="form-control "
            rows="3"
            type="text"
            :value="value"
            @focus="lastValid = $event.target.value"
            @change="updateState"></textarea>
</template>

<script>

export default {
  name: "TextArea",
  props: ['identity'],
  data() {
    return {
      lastValid: null
    }
  },
  methods: {
/*    updateState(e) {
      this.$store.dispatch('updateData', {identity: this.identity, value: e.target.value});
    },*/
  },
  computed: {
/*    value() {
      return this.identity.reduce((acc, c) => acc && acc[c], this.$store.state)
    }*/
  }

}
</script>

<style scoped>

</style>
