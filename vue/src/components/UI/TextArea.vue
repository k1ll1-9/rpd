<template>
  <textarea class="form-control "
            type="text"
            :value="value"
            @change="updateState"></textarea>
</template>
<script>

export default {
  name: "TextArea",
  props: ['identity'],
  data() {
    return {
    }
  },
  methods: {
    async updateState(e) {
      console.log(this.identity)
      await this.$store.dispatch('rpd/updateData', {
        identity: this.identity,
        value: e.target.value,
        updateType: 'UPDATE_RPD_ITEM'
      });
    },
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
