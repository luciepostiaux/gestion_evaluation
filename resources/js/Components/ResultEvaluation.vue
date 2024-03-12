<script setup>
import { Head, Link, router } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
import { useForm } from "@inertiajs/vue3";
import { ref, defineProps, computed } from "vue";
import InputError from "./InputError.vue";
import DangerButton from "@/Components/DangerButton.vue";
const props = defineProps({
  lesson: Object,
  student: Object,
  aas: Array,
  skills: Array,
  lessonStatus: Number, // Ajoutez cette ligne
});
const showRefuseBanner = ref(false);
const showAcceptBanner = ref(false);

const showBanner = ref(false);
const showSkills = ref(false);
const editingCriteriaStudentId = ref(null);
const formEditCriteriaStudent = useForm({
  note: "",
  criteria_id: "",
  student_id: props.student.id,
});

const startEditingCriteriaStudent = (criteria) => {
  console.log(criteria);
  editingCriteriaStudentId.value = criteria.id; // Modifiez cette ligne
  formEditCriteriaStudent.note = criteria.studentNote.note;
  formEditCriteriaStudent.student_id = props.student.id;
  formEditCriteriaStudent.criteria_id = criteria.id;
};

const stopEditingCriteriaStudent = () => {
  editingCriteriaStudentId.value = null;
};
const saveCriteriaStudent = () => {
  formEditCriteriaStudent.put(
    route("criteriastudents.update", editingCriteriaStudentId.value),
    {
      onSuccess: () => stopEditingCriteriaStudent(),
    }
  );
};

const editingSkillStudentId = ref(null);
const formEditSkillStudent = useForm({
  note: null,
  skill_id: "",
  student_id: props.student.id,
});

const startEditingSkillStudent = (skill) => {
  editingSkillStudentId.value = skill.id;
  formEditSkillStudent.note = skill.studentNote.note;
  formEditSkillStudent.student_id = props.student.id;
  formEditSkillStudent.skill_id = skill.id;
  console.log(formEditSkillStudent);
};

const stopEditingSkillStudent = () => {
  editingSkillStudentId.value = null;
};
const skillNoteError = ref("");

const saveSkillStudent = () => {
  const skill = props.skills.find(
    (skill) => skill.id === editingSkillStudentId.value
  );
  if (formEditSkillStudent.note > skill.notation) {
    skillNoteError.value =
      "La note ne peut pas être supérieure à la notation maximale du skill.";
    return;
  }

  skillNoteError.value = "";
  formEditSkillStudent.put(
    route("skillstudents.update", editingSkillStudentId.value),
    {
      onSuccess: () => stopEditingSkillStudent(),
    }
  );
};

const evaluateStudent = () => {
  const allEvaluated = props.aas.every((aa) =>
    aa.criteria.every(
      (criteria) => criteria.studentNote && criteria.studentNote.note !== null
    )
  );
  console.log(props.lessonStatus);
  const anyNonAcquired = props.aas.some((aa) =>
    aa.criteria.some(
      (criteria) =>
        criteria.studentNote && parseInt(criteria.studentNote.note, 10) === 0
    )
  );
  if (props.lessonStatus === 3) {
    showAcceptBanner.value = true;
  } else if (!allEvaluated) {
    showBanner.value = true;
    showSkills.value = false;
  } else if (anyNonAcquired) {
    showSkills.value = false;
    // Utilisez lessonStatus pour déterminer la route à suivre
    if (props.lessonStatus === 0) {
      router.get(
        route("results.adjournement", [props.lesson.id, props.student.id])
      );
    } else if (props.lessonStatus === 1) {
      router.get(route("results.refuse", [props.lesson.id, props.student.id]));
    } else if (props.lessonStatus === 2) {
      showRefuseBanner.value = true;
    }
  } else {
    showBanner.value = false;
    showSkills.value = true;
  }
};
const calculateFinalResult = () => {
  const allSkillsEvaluated = props.skills.every(
    (skill) => skill.studentNote && skill.studentNote.note !== null
  );

  if (!allSkillsEvaluated) {
    alert(
      "Tous les skills doivent être évalués pour calculer le résultat final."
    );
    return;
  }

  const basePercentage = 50;
  let totalWeightedScores = 0;
  let totalWeights = 0;

  props.skills.forEach((skill) => {
    const weight = skill.notation;
    const score = (skill.studentNote.note / skill.notation) * weight;
    totalWeightedScores += score;
    totalWeights += weight;
  });

  const skillPercentage = (totalWeightedScores / totalWeights) * 50; // Pour obtenir le pourcentage des 50% restants
  const finalResult = basePercentage + skillPercentage;
  router.get(
    route("results.accept", {
      studentId: props.student.id,
      lessonId: props.lesson.id,
    }) + `?finalResult=${finalResult.toFixed(2)}`
  );
};
</script>

<template>
  <Link
    class="cursor-pointer text-white bg-[#1F2D55] p-4 m-4 rounded-lg hover:scale-105"
    :href="route('lessons.index', lesson.id)"
    >{{ lesson.name }}
  </Link>
  <div class="flex flex-row border-2 border-black p-8 mt-4">
    <!-- Rectangle de gauche -->
    <div class="w-1/2 border-black pr-2 py-2">
      <div class="flex items-left justify-left h-full">
        <Link :href="route('dashboard')" class="flex items-center w-full">
          <ApplicationMark class="block h-full w-auto" />
        </Link>
      </div>
    </div>
    <!-- Rectangle de droite -->
    <div class="w-1/2 border border-black pl-2 py-2 font-light">
      <p class="text-left">
        Nom et prénom de l'étudiante : {{ student.firstname }}
        {{ student.lastname }}
      </p>
      <p class="text-left">Section :</p>
      <p class="text-left">Unité d'enseignement :{{ lesson.name }}</p>
      <p class="text-left">Code de l'UE :</p>
      <p class="text-left">Nom du/des chargé(e)s de cours :</p>
      <p class="text-left">Année scolaire :</p>
    </div>
  </div>
  <div class="evaluation-container">
    <div class="aas-container text-center">
      <div v-for="aa in aas" :key="aa.id" class="aa text-center">
        <h1 class="text-2xl font-bold">AA : {{ aa.name }}</h1>
        <ul>
          <li
            class="flex border-2 border-[#1F2D55] p-4 my-2"
            v-for="criteria in aa.criteria"
            :key="criteria.id"
          >
            <span
              class="w-2/6 border-r-2 mr-2 border-[#1F2D55] flex items-center justify-start"
            >
              Critère : {{ criteria.name }}
            </span>
            <span
              class="w-3/6 overflow-y-scroll text-xs border-r-2 mr-2 items-center justify-center flex border-[#1F2D55]"
            >
              {{ criteria.description }}</span
            >
            <div
              class="text-center w-1/6"
              v-if="editingCriteriaStudentId === criteria.id"
            >
              <div class="flex w-full text-center items-center justify-center">
                <label class="flex text-xs flex-col items-center mr-2">
                  <input
                    class="hover:scale-105 transition duration-600 ease-in-out"
                    type="radio"
                    :name="`criteria-${criteria.id}`"
                    value="1"
                    v-model="formEditCriteriaStudent.note"
                  />
                  Acquis
                </label>
                <label class="flex flex-col text-xs items-center ml-2">
                  <input
                    class="hover:scale-105 transition duration-600 ease-in-out"
                    type="radio"
                    :name="`criteria-${criteria.id}`"
                    value="0"
                    v-model="formEditCriteriaStudent.note"
                  />
                  Non Acquis
                </label>
              </div>
              <button
                class="text-xs bg-[#1F2D55] text-white p-2 mt-2 rounded-lg hover:scale-105 transition duration-600 ease-in-out"
                @click="saveCriteriaStudent(criteria.studentNote.id)"
              >
                Valider
              </button>
            </div>
            <div
              v-else
              class="w-1/6 flex items-center jsutify-center text-center"
            >
              <button
                class="text-center w-full text-3xl hover:scale-105 transition duration-600 ease-in-out"
                @click="startEditingCriteriaStudent(criteria)"
              >
                ✐
              </button>
            </div>
          </li>
        </ul>
      </div>
      <button
        class="p-4 bg-[#1F2D55] text-white rounded-lg my-2 hover:scale-105 transition duration-600 ease-in-out"
        @click="evaluateStudent"
      >
        Évaluation finale
      </button>
      <div v-if="showBanner">
        <div
          class="bottom-0 right-0 m-4 z-50 bg-[#1F2D55] text-white rounded-xl fixed hover:scale-105 transition duration-600 ease-in-out"
        >
          <p class="p-4">
            Certains critères ne sont pas évalués.
          </p>
          <button
            class="absolute top-0 right-0 text-xl mr-1 w-full h-full flex items-start justify-end"
            @click="showBanner = false"
          >
            ×
          </button>
        </div>
      </div>
      <div v-if="showRefuseBanner">
        <div
          class="bottom-0 right-0 m-4 z-50 bg-[#1F2D55] text-white rounded-xl fixed hover:scale-105 transition duration-600 ease-in-out"
        >
          <p class="p-4">
            L'élève est déjà en refus
          </p>
          <button
            class="bottom-0 right-0 m-4 z-50 bg-[#1F2D55] text-white rounded-xl fixed hover:scale-105 transition duration-600 ease-in-out"
            @click="showRefuseBanner = false"
          >
            ×
          </button>
        </div>
      </div>
      <div v-if="showAcceptBanner">
        <div
          class="bottom-0 right-0 m-4 z-50 bg-[#1F2D55] text-white rounded-xl fixed hover:scale-105 transition duration-600 ease-in-out"
        >
          <p class="p-4">
            L'élève a déjà réussi
          </p>
          <button
            class="absolute top-0 right-0 text-xl mr-1 w-full h-full flex items-start justify-end"
            @click="showAcceptBanner = false"
          >
            ×
          </button>
        </div>
      </div>
    </div>
    <div v-if="showSkills" class="border-2 border-[#1F2D55] text-center w-full">
      <h2 class="text-4xl">Skills</h2>
      <div class="flex">
        <div v-for="skill in skills" :key="skill.id" class="max-w-[20%]">
          <div
            class="flex flex-col bg-slate-200 shadow-lg border p-2 rounded-lg mx-2 text-xs"
          >
            <p class="pr-2 border-b-2 mb-2 border-[#1F2D55] break-words">
              {{ skill.name }}
            </p>
            <div v-if="editingSkillStudentId === skill.id">
              <input
                class=""
                type="number"
                v-model="formEditSkillStudent.note"
              />
              <p class="ml-2 text-base font-bold">/ {{ skill.notation }}</p>
              <button
                class="mx-2 p-4 bg-[#1F2D55] rounded-lg text-white hover:scale-105"
                @click="saveSkillStudent(skill.studentNote.id)"
              >
                Valider
              </button>
              <p v-if="skillNoteError" class="text-red-500">
                {{ skillNoteError }}
              </p>
            </div>
            <div v-else class="ml-2 text-base font-bold">
              {{ skill.studentNote.note }}/ {{ skill.notation }}
              <button @click="startEditingSkillStudent(skill)">✐</button>
            </div>
          </div>
        </div>
      </div>
      <button
        class="p-4 bg-[#1F2D55] text-white rounded-lg my-2"
        @click="calculateFinalResult"
      >
        Calculer le résultat final
      </button>
    </div>
  </div>
</template>
