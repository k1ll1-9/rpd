<template>
  <div class="wrapper" id="authors">
    <span v-if="!isValid" class="error">Должны быть запролнены все поля</span>
    <div class="my-4">
      <p class="text-start my-1">Разработчик программы:</p>
      <TextInput class="my-2 author-input"
                 :class="{invalid: $store.state.rpd.managed.authors.author.FIO === ''}"
                 placeholder='ФИО'
                 @change="validate()"
                 :identity="['managed','authors','author','FIO']"/>
      <TextInput class="my-2 author-input"
                 :class="{invalid: $store.state.rpd.managed.authors.author.position === ''}"
                 placeholder='Должность'
                 @change="validate()"
                 :identity="['managed','authors','author','position']"/>
    </div>
    <div class="my-4">
      <p class="text-start my-1">Рецензент:</p>
      <TextInput class="my-2 author-input"
                 :class="{invalid: $store.state.rpd.managed.authors.reviewer.FIO === ''}"
                 placeholder='ФИО'
                 @change="validate()"
                 :identity="['managed','authors','reviewer','FIO']"/>
      <TextInput class="my-2 author-input"
                 :class="{invalid: $store.state.rpd.managed.authors.reviewer.position === ''}"
                 placeholder='Должность'
                 @change="validate()"
                 :identity="['managed','authors','reviewer','position']"/>
    </div>
  </div>
</template>

<script>

import TextInput from "../UI/TextInput";
import {mapState} from "vuex";

export default {
  name: "Authors",
  components: {TextInput},
  data() {
    return {
      isValid: true
    }
  },
  computed: mapState({
    ...mapState({
      authors: state => state.rpd.managed.authors
    })
  }),
  methods: {
    validate() {
      let valid = true

      Object.values(this.$store.state.rpd.managed.authors)
          .reduce((acc, c) => [...acc, ...Object.values(c)], [])
          .forEach((el) => {
            if (el.trim() === '') {
              valid = false
            }
          })
      this.isValid = valid
    }
  },
  watch: {
    isValid(val) {
      const data = {
        order: 0,
        id: 'authors',
        desc: 'Авторы'
      }
      if (val) {
        this.$store.commit('rpd/REMOVE_ERROR', data);
      } else {
        this.$store.commit('rpd/ADD_ERROR', data);
      }
    }
  },
  mounted() {
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
