<template>
  <div class="wrapper" id="authors">
    <div v-if="!isValid" class="error mb-4">Должны быть запролнены все поля</div>
    <div class="my-4">
      <p class="text-start my-1">Разработчик программы:</p>
      <TextArea class="my-2 author-input"
                rows="3"
                placeholder='ФИО'
                ref="authorFIO"
                @input="validate()"
                :identity="['managed','authors','author','FIO']"
                :disabled="$store.state.rpd.locked"/>
      <TextArea class="my-2 author-input"
                rows="3"
                placeholder='Должность'
                ref="authorPosition"
                @input="validate()"
                :identity="['managed','authors','author','position']"
                :disabled="$store.state.rpd.locked"/>
    </div>
    <div class="my-4">
      <p class="text-start my-1">Рецензент:</p>
      <TextArea class="my-2 author-input"
                rows="3"
                placeholder='ФИО'
                ref="reviewerFIO"
                @input="validate()"
                :identity="['managed','authors','reviewer','FIO']"
                :disabled="$store.state.rpd.locked"/>
      <TextArea class="my-2 author-input"
                rows="3"
                placeholder='Должность'
                ref="reviewerPosition"
                @input="validate()"
                :identity="['managed','authors','reviewer','position']"
                :disabled="$store.state.rpd.locked"/>
    </div>
  </div>
</template>

<script>

import {mapState} from "vuex";
import required from "@/mixins/required";
import TextArea from "@/components/UI/TextArea.vue";

export default {
  name: "Authors",
  mixins: [required],
  components: {TextArea},
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
