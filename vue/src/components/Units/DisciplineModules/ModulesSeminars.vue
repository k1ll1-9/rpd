<template>
  <div class="my-5">
    <h3>5.2 Планы семинарских / практических занятий (если предусмотрены учебным планом)</h3>
    <div v-for="(seminar,index) in seminars" :key="index" class="my-4">
<!--      <div class="my-5">
        <h4 class="my-5">Семинар {{ index + 1 }}. {{ seminar.title }}</h4>
        <VisualEditor class="my-5" :identity="seminar.identity"/>
      </div>-->
    </div>
  </div>
</template>

<script>

//import VisualEditor from "../../UI/VisualEditor";
import {mapState} from "vuex";

export default {
  //components: {VisualEditor},
  name: 'ModulesSeminars',
  computed:
      mapState({
        seminars: state => {
          const seminars = {}

          state.managed.disciplineStructure.forEach((el, i) => {

            if (el.title === null) {
              return;
            }

            if (seminars[el.title] === undefined) {
              seminars[el.title] = {};
            }
console.log(seminars)
            if (el.semester !== null) {
              seminars[el.title][el.semester] = {
                'seminars': el.seminars,
                'identity': ['managed','disciplineStructure', i, 'seminars']
              }
            }

          })

          return seminars
/*          return state.managed.disciplineStructure.filter((el) => el.load?.seminars && el.load?.seminars !== 0)
              .map((el, i) => {
                console.log(el)
                return {
                  ...el,
                  'count': el.load.seminars / 2,
                  'identity': ['managed', 'disciplineStructure', i, 'seminarsDescription'],
                }
              })*/
        }
      }),
  methods: {},
}
</script>

<style scoped>

</style>
