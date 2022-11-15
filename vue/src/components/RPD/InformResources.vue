<template>
  <div class="my-5">
    <h3 class="my-4" :id="$store.state.rpd.static.unitTitles[8].code">8. {{
        $store.state.rpd.static.unitTitles[8].title
      }}</h3>
    <div class="d-flex flex-column align-items-center p-1">
      <p><i>Для изменения порядка пунктов зажмите курсором номер пункта и перетащите.</i></p>

      <div v-for="(unit,infIndex,i) in informationalResources" :key="infIndex+'_'+ i" class="resources-unit w-100">
        <h4 class="my-3">8.{{ i + 1 }} {{ unit.name }}</h4>
        <Draggable
            :list="unit.data"
            item-key="value"
            v-bind="dragOptions"
            handle=".handle"
            @change="updateUnit(infIndex)"
            class="w-100"
            :disabled="$store.state.rpd.locked">
          <template #item="element" class="w-100">
            <div class="d-flex w-100 my-1 draggable-item w-100">
              <p class="number d-flex align-items-center justify-content-center handle text-center">
                {{ element.index + 1 }}.
              </p>
              <TextArea
                  :identity="['managed','informationalResources',infIndex,'data',element.index,'value']"
                  :ref="`type_${infIndex}_resource_${element.index}`"
                  @input="validate()"
                  class="my-2"
                  rows="3"
                  :disabled="$store.state.rpd.locked"/>
              <button type="button"
                      v-if="unit.data.length > 1"
                      @click="removeResult(['managed','informationalResources',infIndex,'data'],element.index)"
                      class="btn btn-danger m-2 align-self-center"
                      :class="{'disabled' : $store.state.rpd.locked}">
                <BIconX-octagon class="cross"/>
              </button>
            </div>
          </template>
        </Draggable>
        <button type="button"
                @click="addResult(['managed','informationalResources',infIndex,'data'])"
                class="btn btn-primary mt-2"
                :class="{'disabled' : $store.state.rpd.locked}">
          Добавить ссылку(книгу)
        </button>
      </div>
    </div>

  </div>
</template>

<script>


import TextArea from "../UI/TextArea";
import {mapActions, mapState} from "vuex";
import Draggable from "vuedraggable";
import required from "../../mixins/required";

export default {
  components: {TextArea, Draggable},
  mixins: [required],
  name: "InformResources",
  data() {
    return {
      requiredFields: [],
      noticeData: {
        order: 10,
        id: this.$store.state.rpd.static.unitTitles[8].code,
        desc: 'Учебно-методическое и информационное обеспечение дисциплины'
      }
    }
  },
  computed: {
    ...mapState({
      informationalResources: state => state.rpd.managed.informationalResources,
    }),
    dragOptions() {
      return {
        animation: 200,
        group: "description",
        disabled: false,
        ghostClass: "ghost"
      };
    }
  },
  methods: {
    ...mapActions({
      updateData: 'rpd/updateData'
    }),
    async addResult(identity) {
      await this.updateData({
        identity: identity,
        updateType: 'PUSH_RPD_ITEM'
      })
      this.checkRequired()
      this.validate()
    },
    async removeResult(identity, index) {
      await this.updateData({
        identity: identity,
        index: index,
        updateType: 'SPLICE_RPD_ITEM'
      })
      this.checkRequired()
      this.validate()
    },
    updateUnit(infIndex) {
      this.$store.dispatch('rpd/updateData', {
        identity: ['managed', 'informationalResources', infIndex],
        value: this.informationalResources[infIndex],
        updateType: 'UPDATE_RPD_ITEM'
      });
    },
    checkRequired() {
      this.requiredFields = Object.entries(this.$refs)
          .filter(([k, v]) => {
            return k.includes('resource') && v !== null
          })
          .map(([, v]) => v)
    }
  },
  mounted() {
    this.checkRequired()
    this.validate()
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

.cross {
  height: 25px;
}
</style>
