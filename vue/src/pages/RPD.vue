<template>
  <div v-if="ready">
    <template v-if="!external">
      <Navigation/>
    </template>
    <EntryBlock/>
    <template v-if="!external">
      <Authors/>
      <Target/>
      <Place/>
      <Competencies/>
      <div class="my-5">
        <h2 class="my-4" :id="unitTitles[4].code">4. {{ unitTitles[4].title }}</h2>
        <DisciplineValue/>
        <DisciplineStructure/>
      </div>
      <div class="my-5">
        <h2 class="my-4" :id="unitTitles[5].code">5. {{ unitTitles[5].title }}</h2>
        <ModulesThemes/>
        <ModulesSeminars/>
        <ModulesSRS/>
      </div>
      <Technologies/>
      <Annotation/>
      <InformResources/>
      <div class="my-5">
        <h2 class="my-4" :id="unitTitles[9].code">9. {{ unitTitles[9].title }}</h2>
        <GradesCurrent/>
        <GradesCurrentDescription/>
        <GradesIntermediate/>
      </div>
    </template>
    <div class="d-flex align-items-start justify-content-center mt-5">
      <div>
        <PDFButton v-if="!external"/>
      </div>
      <div class="ms-5">
        <AttachmentInput
          :name="'attachment.pdf'"
          :label="external ? 'Загрузить РПД' : 'Загрузить приложение'"
          :id="'RPDAttachment'"
          :buttonClass="'btn btn-primary btn-lg mb-1'"
          :allowedTypes="['pdf']"
          :errorMessage="external ? 'РПД должно быть в формате PDF' : 'Приложение должно быть в формате PDF'"
          :options="{
            addAction: 'uploadRPDAttachment',
            deleteAction: 'deleteRPDFile',
            params : this.$route.query,
            disabled: $store.state.rpd.locked
          }"
        />
      </div>
      <ApprovalButton
        :disabled="!isValid
          || !canSubmit
          || $store.state.rpd.locked
          || (external && !$store.state.rpd.attachment)"
        :canRecall="canSubmit && $store.state.rpd.locked"
        :approvalType="getApprovalType()"
      />
    </div>
    <div>
      <span v-if="!canSubmit && !external" class="error mt-2 d-inline-block">На согласование РПД отправить может только её автор</span>
    </div>
    <NoticeWindow v-if="!isValid"/>
  </div>
  <Preloader v-else style="margin-top: 200px"/>
</template>

<script>
import Authors from "./../components/RPD/Authors";
import Place from "./../components/RPD/Place";
import ModulesSeminars from "./../components/RPD/DisciplineModules/ModulesSeminars";
import ModulesThemes from "./../components/RPD/DisciplineModules/ModulesThemes.vue";
import DisciplineValue from './../components/RPD/DisciplineStructure/DisciplineValue.vue'
import DisciplineStructure from './../components/RPD/DisciplineStructure/DisciplineStructure.vue'
import EntryBlock from "./../components/RPD/EntryBlock";
import Target from "./../components/RPD/Target";
import Competencies from "./../components/RPD/Competencies";
import ModulesSRS from "./../components/RPD/DisciplineModules/ModulesSRS";
import Navigation from "./../components/RPD/Navigation";
import ApprovalButton from "./../components/RPD/ApprovalButton";
import PDFButton from "./../components/RPD/PDFButton";
import Preloader from "./../components/Misc/Preloader";
import GradesCurrent from "./../components/RPD/Grades/GradesCurrent"
import GradesCurrentDescription from "./../components/RPD/Grades/GradesCurrentDescription";
import GradesIntermediate from "../components/RPD/Grades/GradesIntermediate";
import Technologies from "../components/RPD/EducationTechnologies";
import InformResources from "./../components/RPD/InformResources";
import Annotation from "@/components/RPD/Annotation";
import NoticeWindow from "@/components/RPD/NoticeWindow";
import AttachmentInput from "@/components/UI/FileInputs/AttachmentInput.vue";
import {mapState} from "vuex";

export default {
  name: "RPD",
  components: {
    Annotation,
    Technologies,
    Place,
    Preloader,
    PDFButton,
    Navigation,
    ModulesSeminars,
    ModulesSRS,
    EntryBlock,
    Target,
    Competencies,
    DisciplineValue,
    DisciplineStructure,
    ModulesThemes,
    GradesCurrent,
    GradesCurrentDescription,
    Authors,
    InformResources,
    GradesIntermediate,
    ApprovalButton,
    AttachmentInput,
    NoticeWindow,
  },
  data() {
    return {
      ready: false,
      external: this.$route.query.external === 'true',
      externalApproval: ['МИФИ','РАНХиГС']
    }
  },
  computed: {
    ...mapState({
      unitTitles: state => state.rpd.static.unitTitles,
      isValid: state => {
        if (state.rpd.errors === undefined) {
          return true
        } else {
          return state.rpd.errors.length === 0
        }
      },
      canSubmit (state)  {

        if (state.user.role === 'admin' || this.external) {
          return true
        }

        if (state.user.lastName === null) {
          return false
        }

        const authors = state.rpd.managed.authors?.author?.FIO?.toLowerCase()
        const currentUser = state.user.lastName.toLowerCase()

        if (authors === undefined) {
          return false
        }

        return authors.includes(currentUser)
      }
    })

  },
  methods:{
    getApprovalType(){
      return this.externalApproval.includes(this.$route.query.kafedra) ? 'extApproval' : 'self'
    }
  },
  async mounted() {
    this.ready = await this.$store.dispatch('rpd/initData', this.$route.query)
    this.$watch('isValid', (val) => {
      this.$store.dispatch('rpd/setStatus', {
        statusName: 'valid',
        status: val ? 'valid' : 'invalid'
      })
    })

    if (this.$route.query?.validationCycle === 'true') {
      window.location.href = 'https://lk.vavt.ru/local/components/syllabuses/main/templates/.default/api/validator.php'
    }

  },
}
</script>

<style>
.invalid, .invalid.form-control:focus {
  border-color: #FF2400 !important;
  box-shadow: 0 0 0 0.25rem rgb(253, 13, 13, 0.25) !important;
}

.error {
  color: #FF2400;
  font-weight: 700;
}

/*кастомизация верстки селектов - не работают scoped компонетов*/
.e-input-group:has(> .invalid.e-dropdownlist),
.e-multi-select-wrapper.invalid {
  border: 1px solid #FF2400 !important;
  border-radius: 5px;
  box-shadow: 0 0 0 0.25rem rgb(253, 13, 13, 0.25) !important;
}

.e-input-group:has(>.e-dropdownlist) {
  top: 2px;
}

.defaults.e-ddl.e-input-group.e-control-wrapper .e-input {
  text-align: center;
}

.defaults .e-list-item {
  color: #000000;
}

.defaults .e-dropdownbase .e-list-item:active {
  color: #0b66c3;
}

.defaults.e-input-group:not(.e-float-icon-left):not(.e-float-input)::before,
.defaults.e-input-group:not(.e-float-icon-left):not(.e-float-input)::after {
  height: 2px;
  background: #0b66c3;
}

.defaults .e-dropdownbase .e-list-item.e-active,
.defaults .e-dropdownbase .e-list-item.e-active.e-hover {
  color: #0b66c3;
}

.e-input-group:not(.e-float-icon-left):not(.e-float-input)::before, .e-input-group:not(.e-float-icon-left):not(.e-float-input)::after, .e-input-group.e-float-icon-left:not(.e-float-input) .e-input-in-wrap::before, .e-input-group.e-float-icon-left:not(.e-float-input) .e-input-in-wrap::after, .e-input-group.e-control-wrapper:not(.e-float-icon-left):not(.e-float-input)::before, .e-input-group.e-control-wrapper:not(.e-float-icon-left):not(.e-float-input)::after, .e-input-group.e-control-wrapper.e-float-icon-left:not(.e-float-input) .e-input-in-wrap::before, .e-input-group.e-control-wrapper.e-float-icon-left:not(.e-float-input) .e-input-in-wrap::after {
  color: blueviolet !important;
}

</style>
