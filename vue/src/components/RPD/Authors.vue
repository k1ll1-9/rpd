<template>
  <div class="wrapper" id="authors">
    <div v-if="!isValid" class="error mb-4">Должны быть запролнены все поля</div>
    <div class="my-4">
      <p class="text-start my-1">Разработчик программы:</p>
      <TextInput class="my-2 author-input"
                 placeholder='ФИО'
                 ref="authorFIO"
                 @input="validate()"
                 :identity="['managed','authors','author','FIO']"
                 :disabled="$store.state.rpd.locked"/>
      <TextInput class="my-2 author-input"
                 placeholder='Должность'
                 ref="authorPosition"
                 @input="validate()"
                 :identity="['managed','authors','author','position']"
                 :disabled="$store.state.rpd.locked"/>
    </div>
    <div class="my-4">
      <p class="text-start my-1">Рецензент:</p>
      <TextInput class="my-2 author-input"
                 placeholder='ФИО'
                 ref="reviewerFIO"
                 @input="validate()"
                 :identity="['managed','authors','reviewer','FIO']"
                 :disabled="$store.state.rpd.locked"/>
      <TextInput class="my-2 author-input"
                 placeholder='Должность'
                 ref="reviewerPosition"
                 @input="validate()"
                 :identity="['managed','authors','reviewer','position']"
                 :disabled="$store.state.rpd.locked"/>
    </div>
  </div>
</template>

<script>

import TextInput from "../UI/TextInput";
import {mapState} from "vuex";
import required from "@/mixins/required";

export default {
  name: "Authors",
  mixins: [required],
  components: {TextInput},
  data() {
    return {
      requiredFields: [],
      noticeData: {
        order: 0,
        id: 'authors',
        desc: 'Авторы'
      }
    }
  },
  computed: {
    ...mapState({
      authors: state => state.rpd.managed.authors
    })
  },
  methods: {},
  mounted() {
    this.requiredFields = [
      this.$refs.authorFIO,
      this.$refs.authorPosition,
      this.$refs.reviewerFIO,
      this.$refs.reviewerPosition
    ]
    this.validate()
  }
}
</script>

<style scoped>
p {
  margin: 0;
}

.wrapper {
  margin: 40px 0;
}

.author-input {
  width: 40%;
}

</style>
