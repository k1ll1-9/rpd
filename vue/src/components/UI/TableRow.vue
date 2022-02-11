<template>
    <tr>
      <td>
        <span>{{ index + 1 }}</span>
      </td>
      <td>
        <div class="input-group">
          <RPDInput @change="updateField"
                    v-model="inputs.semestr"
                    type="text"
                    name="semestr"
          />
        </div>
      </td>
      <td>
        <div class="input-group">
          <RPDInput @change="updateField"
                    type="text"
                    v-model="inputs.name"
                    name="name"
          />
        </div>
      </td>
      <td>
        <div class="input-group">
          <RPDInput @change="updateField"
                    type="number"
                    v-model="inputs.lectures"
                    name="lectures"
          />
        </div>
      </td>
      <td>
        <button type="button"
                @click="$emit('deleteRow',index)"
                class="btn btn-danger">
          Удалить
        </button>
      </td>
    </tr>
</template>

<script>
import RPDInput from "./RPDInput";

export default {
  components: {
    RPDInput
  },
  name: "TableRow",
  props: {
    index: Number,
    item: Object
  },
  computed: {
    inputs: function () {
      return {...this.item}
    }
  },
  methods: {
    updateField(e) {
      this.$emit('updateField', {
        index: this.index,
        name: e.target.name,
        value: e.target.value
      });
    }
  }
}
</script>

<style scoped>
td {
  vertical-align: middle;
}
</style>