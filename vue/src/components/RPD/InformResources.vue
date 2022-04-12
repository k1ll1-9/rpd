<template>
  <div class="my-5">
    <h3 class="my-4" :id="$store.state.rpd.static.unitTitles[8].code">8. {{
        $store.state.rpd.static.unitTitles[8].title
      }}</h3>
    <div class="d-flex flex-column align-items-center p-1">
      <div class="d-flex flex-column w-100"
           v-for="(link,index) in informationalResources"
           :key="index">
        <div class="d-flex align-items-center w-100">
          <div class="number">
            {{ index + 1 }}.
          </div>
          <TextArea class="my-2 w-100" rows="1" :identity="['managed','informationalResources',index,'value']"/>
          <button type="button"
                  v-if="informationalResources.length > 1"
                  @click="removeResult(['managed','informationalResources'],index)"
                  class="btn btn-danger m-2">
            <BIconX-octagon class="cross"/>
          </button>
        </div>
        <div class="w-75 align-self-center">
          <Select :identity="['managed','informationalResources',index,'type']"
                  :dataSource="$store.state.rpd.static.informationalResources"
                  :placeholder="'Тип информационного ресурса'"
                  cssClass="defaults"
                  width="50%"/>
        </div>
      </div>
      <button type="button"
              @click="addResult(['managed','informationalResources'])"
              class="btn btn-primary mt-2">
        Добавить ссылку
      </button>
    </div>
  </div>
</template>

<script>

import TextArea from "../UI/TextArea";
import {mapActions, mapState} from "vuex";
import Select from "@/components/UI/Select";

export default {
  components: {Select, TextArea},
  name: "InformResources",
  data() {
    return {}
  },
  computed:
      mapState({
        informationalResources: state => {
          return state.rpd.managed.informationalResources
        }
      }),
  methods: {
    ...mapActions({
      updateData: 'rpd/updateData'
    }),
    addResult(identity) {
      this.updateData({
        identity: identity,
        updateType: 'PUSH_RPD_ITEM'
      })
    },
    removeResult(identity, index) {
      this.updateData({
        identity: identity,
        index: index,
        updateType: 'SPLICE_RPD_ITEM'
      })
    }
  }
}
</script>

<style scoped>
.number {
  margin-right: 10px;
  font-weight: 600;
  font-size: 18px;
}
</style>
