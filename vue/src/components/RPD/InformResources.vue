<template>
  <div class="my-5">
    <h3 class="my-4" :id="$store.state.rpd.static.unitTitles[8].code">8. {{
        $store.state.rpd.static.unitTitles[8].title
      }}</h3>
    <div class="d-flex flex-column align-items-center p-1">
      <p><i>Для изменения порядка пунктов зажмите курсором номер пункта и перетащите.</i></p>

      <div v-for="(unit,type,i) in informationalResources" :key="type" class="resources-unit w-100">
        <h4 class="my-3">8.{{ i + 1 }} {{ type }}</h4>
        <Draggable
            :list="unit"
            item-key="index"
            v-bind="dragOptions"
            handle=".handle"
            @change="updateUnit(type)"
            class="w-100">
          <template #item="{index}" class="w-100">
            <div class="d-flex w-100 my-1 draggable-item w-100">
              <p class="number d-flex align-items-center justify-content-center handle text-center">
                {{ index + 1 }}.
              </p>
              <TextArea :identity="['managed','informationalResources',type,index,'value']"
                        class="my-2"
                        rows="1"/>
              <button type="button"
                      v-if="unit.length > 1"
                      @click="removeResult(['managed','informationalResources',type],index)"
                      class="btn btn-danger m-2">
                <BIconX-octagon class="cross"/>
              </button>
            </div>
          </template>
        </Draggable>
        <button type="button"
                @click="addResult(['managed','informationalResources',type])"
                class="btn btn-primary mt-2">
          Добавить ссылку
        </button>
      </div>
    </div>

  </div>
</template>

<script>


import TextArea from "../UI/TextArea";
import {mapActions, mapState} from "vuex";
import Draggable from "vuedraggable";

export default {
  components: {TextArea, Draggable},
  name: "InformResources",
  data() {
    return {}
  },
  computed:
      mapState({
        informationalResources: state => state.rpd.managed.informationalResources,
        dragOptions() {
          return {
            animation: 200,
            group: "description",
            disabled: false,
            ghostClass: "ghost"
          };
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
    },
    updateUnit(type) {
      this.$store.dispatch('rpd/updateData', {
        identity: ['managed','informationalResources',type],
        value: this.informationalResources[type],
        updateType: 'UPDATE_RPD_ITEM'
      });
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

.ghost {
  opacity: 0.5;
  background: #c8ebfb;
}

.draggable-item:active {
  border: 1px rgba(30, 27, 27, 0.5) solid;
  border-radius: 5px;
}


.handle {
  cursor: grab;
  min-width: 35px;
  align-self: stretch;
  margin: 0;
}

.handle:active {
  cursor: grabbing;
}
</style>
