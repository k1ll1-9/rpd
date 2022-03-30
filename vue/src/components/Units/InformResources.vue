<template>
  <div class="my-5">
    <h3 class="my-4" :id="$store.state.static.unitTitles[8].code">8. {{ $store.state.static.unitTitles[8].title }}</h3>
    <div class="d-flex flex-column align-items-center p-1">
      <div class="d-flex align-items-center w-100"
           v-for="(link,index) in $store.state.managed.informationalResources"
           :key="index">
        <div class="number">
          {{ index + 1 }}.
        </div>
        <TextArea class="my-2" rows="2" :identity="['managed','informationalResources',index,'value']"/>
        <button type="button"
                v-if="$store.state.managed.informationalResources.length > 1"
                @click="removeResult(['managed','informationalResources'],index)"
                class="btn btn-danger m-2">
          <BIconX-octagon class="cross"/>
        </button>
      </div>
      <button type="button"
              @click="addResult(['managed','informationalResources'])"
              class="btn btn-primary">
        Добавить ссылку
      </button>
    </div>
  </div>
</template>

<script>

import TextArea from "../UI/TextArea";

export default {
  components: {TextArea},
  name: "InformResources",
  data() {
    return {}
  },
  computed: {},
  methods: {
    addResult(identity) {
      this.$store.dispatch('updateData', {
        identity: identity,
        updateType: 'PUSH_RPD_ITEM'
      })
    },
    removeResult(identity, index) {
      this.$store.dispatch('updateData', {
        identity: identity,
        index: index,
        updateType: 'SPLICE_RPD_ITEM'
      })
    }
  }
}
</script>

<style scoped>
.number{
  margin-right: 10px;
  font-weight: 600;
  font-size: 18px;
}
</style>
