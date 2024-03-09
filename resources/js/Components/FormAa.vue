<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, defineProps } from "vue";
import InputError from "./InputError.vue";
import DangerButton from "@/Components/DangerButton.vue";
import { Inertia } from "@inertiajs/inertia";

const showingAddCriteriaForm = ref({}); // Nouveau
const toggleAddCriteriaForm = (aaId) => {
  showingAddCriteriaForm.value[aaId] = !showingAddCriteriaForm.value[aaId];
};

const props = defineProps({
  lesson: Object,
  skills: Array,
  aas: Array,
});
const editingSkillId = ref(null);
const formEditSkill = useForm({
  name: "",
  notation: "",
  lesson_id: props.lesson.id, // Assurez-vous que lesson_id est inclus
});

const startEditingSkill = (skill) => {
  editingSkillId.value = skill.id;
  formEditSkill.name = skill.name;
  formEditSkill.notation = skill.notation;
  formEditSkill.lesson_id = props.lesson.id; // Ajoutez cette ligne
};

const stopEditingSkill = () => {
  editingSkillId.value = null;
};
const saveSkill = () => {
  formEditSkill.put(route("skills.update", editingSkillId.value), {
    onSuccess: () => stopEditingSkill(),
  });
};

const editingAaId = ref(null);
const formAa = useForm({
  name: "",
  lesson_id: props.lesson.id, // Utilisation de lessonId reçu en prop
});

const startEditingAa = (aa) => {
  editingAaId.value = aa.id;
  formAa.name = aa.name;
};

const stopEditingAa = () => {
  editingAaId.value = null;
};

const saveAa = (aaId) => {
  formAa.put(route("aas.update", aaId), {
    preserveScroll: true,
    onSuccess: () => stopEditingAa(),
  });
};

const editingCriteriaId = ref(null);

const startEditingCriteria = (criteria, aaId) => {
  editingCriteriaId.value = criteria.id;
  formCriteria.name = criteria.name;
  formCriteria.aa_id = aaId;
};

const stopEditingCriteria = () => {
  editingCriteriaId.value = null;
};

const saveCriteria = (criteriaId) => {
  console.log(criteriaId);
  formCriteria.put(route("aas.updateCriteria", criteriaId), {
    preserveScroll: true,
    onSuccess: () => stopEditingCriteria(),
  });
};
const deleteAa = (AaId) => {
  if (confirm("Êtes-vous sûr de vouloir supprimer ce AA ?")) {
    Inertia.delete(route("aas.destroy", AaId), {
      preserveScroll: true,
      preserveState: false,
      onSuccess: () => {
        props.aas = props.aas.filter((aa) => aa.id !== AaId);
      },
    });
  }
};
const addCriteria = (aa) => {
  formAddCriteria.aa_id = aa.id;
  formAddCriteria.post(route("aas.addCriteria", { id: aa.id }), {
    onSuccess: () => {
      formAddCriteria.reset("name");
      toggleAddCriteriaForm(aa.id);
    },
  });
};

const deleteCriteria = (criteriaId) => {
  if (confirm("Êtes-vous sûr de vouloir supprimer ce critère ?")) {
    Inertia.delete(route("criterias.destroy", criteriaId), {
      preserveScroll: true,
      preserveState: false,
      onSuccess: () => {
        props.criterias = props.criterias.filter(
          (criteria) => criteria.id !== criteriaId
        );
      },
    });
  }
};

const deleteSkill = (skillId) => {
  if (confirm("Êtes-vous sûr de vouloir supprimer ce skill ?")) {
    Inertia.delete(route("skills.destroy", skillId), {
      preserveScroll: true,
      preserveState: false,
      onSuccess: () => {
        props.skills = props.skills.filter((skill) => skill.id !== skillId);
      },
    });
  }
};
const formCriteria = useForm({
  name: "",
  aa_id: "", // Ajout de aa_id à formCriteria
});

const formAddAa = useForm({
  name: "",
  lesson_id: props.lesson.id, // Utilisation de lessonId reçu en prop
});
const formAddCriteria = useForm({
  name: "",
  aa_id: "", // Utilisation de lessonId reçu en prop
});

const formAddSkill = useForm({
  lesson_id: props.lesson.id,
  name: "",
  notation: "",
});

const addSkill = () => {
  console.log(formAddSkill);
  formAddSkill.post(route("skills.store"), {
    preserveScroll: true,
    onSuccess: () => {
      formAddSkill.reset("name");
      formAddSkill.reset("notation");
    },
  });
};

const addAa = () => {
  formAddAa.post(route("aas.store"), {
    preserveScroll: true,
    onSuccess: () => {
      formAddAa.reset("name");
    },
  });
};
</script>

<template>
  <div class="flex flex-wrap">
    <!-- Colonne pour le bouton Ajouter un AA -->
    <div class="w-full lg:w-1/4 p-4 xl:w-3/4"></div>

    <div class="w-full lg:w-1/4 p-4 xl:w-2/5 xl:text-start">
      <div class="bg-white shadow sm:rounded-md p-4 xl:w-full">
        <div class="mb-6 w-full">
          <div
            class="block text-[#1F2D55] font-poppins text-base font-bold mb-2"
          >
            Acquis d'apprentissage :
          </div>
          <ul>
            <li
              v-for="aa in aas"
              :key="aa.id"
              class="mb-2 py-2 px-3 rounded text-gray-700 leading-tight"
            >
              <div class="flex" v-if="editingAaId === aa.id">
                <input
                  v-model="formAa.name"
                  type="text"
                  class="input rounded border-[#62BFC1]"
                  placeholder="Nom de l'AA"
                />
                <div class="text-end w-full">
                  <button
                    @click="saveAa(aa.id)"
                    class="btn font-semibold text-xl text-white ml-4 px-4 py-1.5 rounded bg-[#62BFC1]"
                  >
                    ✓
                  </button>
                  <button
                    @click="stopEditingAa"
                    class="btn font-semibold text-xl text-white bg-red-600 px-5 py-1.5 rounded ml-2"
                  >
                    ×
                  </button>
                </div>
              </div>
              <div class="flex w-full" v-else>
                {{ aa.name }}
                <div class="text-end w-full">
                  <button
                    @click="startEditingAa(aa)"
                    class="btn font-semibold text-xl text-white px-4 py-1.5 rounded bg-[#62BFC1]"
                  >
                    ✎
                  </button>
                  <DangerButton @click="deleteAa(aa.id)">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24"
                      fill="#FFFFFF"
                      class="size-6"
                    >
                      <path
                        d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 11H11V17H9V11ZM13 11H15V17H13V11ZM9 4V6H15V4H9Z"
                      ></path>
                    </svg>
                  </DangerButton>
                  <button @click="toggleAddCriteriaForm(aa.id)">
                    + Critère
                  </button>
                </div>
              </div>

              <ul class="">
                <li>
                  <div v-if="showingAddCriteriaForm[aa.id]">
                    <input
                      v-model="formAddCriteria.name"
                      type="text"
                      class="input rounded border-[#62BFC1]"
                      placeholder="Nom du critère"
                    />
                    <button @click="addCriteria(aa)">
                      +
                    </button>
                  </div>
                </li>
                <li
                  v-for="criteria in aa.criteria"
                  class="font-semibold text-xs"
                >
                  <div v-if="editingCriteriaId === criteria.id">
                    <input
                      v-model="formCriteria.name"
                      type="text"
                      class="input rounded border-[#62BFC1]"
                      placeholder="Nom du critère"
                    />
                    <button
                      @click="saveCriteria(criteria.id)"
                      class="btn font-semibold text-xl text-white ml-4 px-4 py-1.5 rounded bg-[#62BFC1]"
                    >
                      ✓
                    </button>
                    <button
                      @click="stopEditingCriteria"
                      class="btn font-semibold text-xl text-white bg-red-600 px-5 py-1.5 rounded ml-2"
                    >
                      ×
                    </button>
                  </div>
                  <div class="w-full flex items-center" v-else>
                    <div class="w-1/6">
                      {{ criteria.name }}
                    </div>
                    <div class="text-start pl-4">
                      <button
                        @click="startEditingCriteria(criteria, aa.id)"
                        class="btn font-semibold mx-0.5 text-md w-5 h-5 text-white rounded bg-[#62BFC1]"
                      >
                        ✎
                      </button>
                      <button
                        class="btn font-semibold text-md w-5 h-5 text-white rounded bg-[#ff3f3f]"
                        @click="deleteCriteria(criteria.id)"
                      >
                        x
                      </button>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        <form @submit.prevent="addAa" class="">
          <div class="mb-6">
            <label
              for="aaAdd"
              class="block text-[#1F2D55] font-poppins text-base font-bold mb-2"
              >Ajouter un acquis d'apprentissage :</label
            >
            <input
              type="text"
              id="aaAdd"
              class="shadow border-[#62BFC1] rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-[#62BFC1]"
              placeholder="Entrez l'acquis d'apprentissage"
              v-model="formAddAa.name"
            />

            <InputError :message="formAddAa.errors.name" class="mt-2" />
          </div>
          <div class="flex justify-end">
            <button
              type="submit"
              @click.prevent="addAa"
              class="bg-[#62BFC1] font-poppins text-white text-base font-bold py-2 px-6 rounded"
            >
              Ajouter l'acquis d'apprentissage
            </button>
          </div>
        </form>
      </div>
    </div>

    <div class="w-full lg:w-1/4 p-4 xl:w-2/5 xl:text-center">
      <div class="bg-white shadow sm:rounded-md p-4">
        <div class="mb-6">
          <div
            class="block text-[#1F2D55] font-poppins text-base font-bold mb-2"
          >
            Skills :
          </div>
          <ul>
            <li
              v-for="skill in skills"
              :key="skill.id"
              class="mb-2 py-2 px-3 rounded text-gray-700 leading-tight"
            >
              <div v-if="editingSkillId === skill.id">
                <!-- Les champs d'édition s'affichent pour modifier le skill -->
                <input
                  v-model="formEditSkill.name"
                  placeholder="Nom du skill"
                />
                <input
                  v-model="formEditSkill.notation"
                  placeholder="Notation"
                  type="number"
                />
                <button class="text-2xl" @click="saveSkill(skill.id)">✓</button>
                <button @click="stopEditingSkill">×</button>
              </div>
              <div v-else>
                <!-- Affichage normal du skill -->
                {{ skill.name }} : {{ skill.notation }}
                <button @click="startEditingSkill(skill)">✐</button>
                <DangerButton @click="deleteSkill(skill.id)">
                  <!-- Icône de suppression -->
                </DangerButton>
              </div>
            </li>
          </ul>
        </div>
        <form @submit.prevent="addSkill" class="">
          <div class="mb-6">
            <label
              for="skillAdd"
              class="block text-[#1F2D55] font-poppins text-base font-bold mb-2"
              >Ajouter un skill :</label
            >
            <input
              type="text"
              id="skillAdd"
              class="shadow border-[#62BFC1] rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-[#62BFC1]"
              placeholder="Entrez le critère de maîtrise"
              v-model="formAddSkill.name"
            />

            <InputError :message="formAddSkill.errors.name" class="mt-2" />
            <input
              type="number"
              v-model="formAddSkill.notation"
              placeholder="Entrez le score maximum"
            />
            <InputError :message="formAddSkill.errors.notation" class="mt-2" />
          </div>
          <div class="flex justify-end">
            <button
              type="submit"
              @click.prevent="addSkill"
              class="bg-[#62BFC1] font-poppins text-white text-base font-bold py-2 px-6 rounded"
            >
              Ajouter le critère de maîtrise
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>
