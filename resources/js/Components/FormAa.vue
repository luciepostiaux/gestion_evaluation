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
  <div class="flex flex-wrap justify-center">
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
                  class="input rounded border-[#62BFC1] text-xs"
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
                <div class="text-end w-full flex justify-end items-center">
                  <button
                    @click="startEditingAa(aa)"
                    class="text-2xl mx-1 hover:scale-105 transition duration-300 ease-in-out"
                  >
                    ✎
                  </button>
                  <button
                    class="text-2xl mx-1 hover:scale-105 transition duration-300 ease-in-out"
                    @click="deleteAa(aa.id)"
                  >
                    ✖
                  </button>
                  <button
                    class="bg-[#1F2D55] p-2 text-xs rounded-lg mx-1 text-white hover:scale-105 transition duration-300 ease-in-out"
                    @click="toggleAddCriteriaForm(aa.id)"
                  >
                    Ajouter Critère
                  </button>
                </div>
              </div>

              <ul class="">
                <li>
                  <div v-if="showingAddCriteriaForm[aa.id]">
                    <input
                      v-model="formAddCriteria.name"
                      type="text"
                      class="input rounded border-[#62BFC1] text-xs"
                      placeholder="Nom du critère"
                    />
                    <button
                      class="bg-[#1F2D55] p-2 ml-4 text-xs text-white rounded-lg hover:scale-105 transition duration-300 ease-in-out"
                      @click="addCriteria(aa)"
                    >
                      Ajouter le critère
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
                      class="input rounded border-[#62BFC1] text-xs"
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
                        class="btn font-semibold mx-0.5 text-md w-5 h-5 text-white rounded bg-[#62BFC1] hover:scale-105 transition duration-300 ease-in-out"
                      >
                        ✎
                      </button>
                      <button
                        class="btn font-semibold text-md w-5 h-5 text-white rounded bg-[#ff3f3f] hover:scale-105 transition duration-300 ease-in-out"
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
              class="shadow border-[#62BFC1] rounded w-full py-2 px-3 text-gray-700 text-xs leading-tight focus:outline-none focus:shadow-outline focus:border-[#62BFC1]"
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

    <div class="w-full lg:w-1/4 p-4 xl:w-2/5 xl:text-center break-words">
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
              <div
                v-if="editingSkillId === skill.id"
                class="flex flex-col items-center justify-center"
              >
                <!-- Les champs d'édition s'affichent pour modifier le skill -->
                <span class="font-bold my-1">Nom</span>
                <input
                  class="input rounded border-[#62BFC1] text-xs mb-2"
                  v-model="formEditSkill.name"
                  placeholder="Nom du skill"
                />
                <span class="font-bold my-1">Note</span>
                <input
                  class="input rounded border-[#62BFC1] text-xs mb-2"
                  v-model="formEditSkill.notation"
                  placeholder="Notation"
                  type="number"
                />
                <div>
                  <button
                    class="text-xs p-2 mx-1 bg-[#1F2D55] rounded-lg text-white hover:scale-105 transition duration-300 ease-in-out"
                    @click="saveSkill(skill.id)"
                  >
                    Valider
                  </button>
                  <button
                    class="text-xs p-2 mx-1 bg-red-600 rounded-lg text-white hover:scale-105 transition duration-300 ease-in-out"
                    @click="stopEditingSkill"
                  >
                    ✖
                  </button>
                </div>
              </div>
              <div
                v-else
                class="w-full flex flex-col items-center justify-center"
              >
                <!-- Affichage normal du skill -->
                <p class="flex flex-col w-3/5">
                  <span class="border-b-2 text-xs border-slate-800 mb-2 pb-2">{{
                    skill.name
                  }}</span>
                  <span class="text-base font-bold">/{{ skill.notation }}</span>
                </p>
                <div class="flex space-x-2">
                  <button
                    class="hover:scale-105"
                    @click="startEditingSkill(skill)"
                  >
                    ✐
                  </button>
                  <button
                    class="hover:scale-105"
                    @click="deleteSkill(skill.id)"
                  >
                    ✖
                  </button>
                </div>
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
              class="shadow my-2 border-[#62BFC1] rounded w-full py-2 px-3 text-gray-700 leading-tight text-xs focus:outline-none focus:shadow-outline focus:border-[#62BFC1]"
              placeholder="Entrez le critère de maîtrise"
              v-model="formAddSkill.name"
            />

            <InputError :message="formAddSkill.errors.name" class="mt-2" />
            <input
              type="number"
              v-model="formAddSkill.notation"
              placeholder="Entrez le score maximum"
              class="shadow my-2 border-[#62BFC1] rounded w-full py-2 px-3 text-xs text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-[#62BFC1]"
            />
            <InputError :message="formAddSkill.errors.notation" class="mt-2" />
          </div>
          <div class="flex justify-center">
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
