<script setup>
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import DangerButton from "@/Components/DangerButton.vue";
import { Inertia } from "@inertiajs/inertia"; // Import Inertia

const props = defineProps({
  lessons: Array,
  lesson: Object,
  students: Array,
  studentslist: Array,
  aa: Array,
  selectedLesson: Object,
  allTeachers: Array, // Ajoutez cette ligne
});
const showAddTeacherInput = ref(false);

const formAddCoTeacher = useForm({
  second_user_id: "",
});
const selectCoTeacher = (event) => {
  formAddCoTeacher.second_user_id = event.target.value;
};

const saveCoTeacher = () => {
  if (formAddCoTeacher.second_user_id) {
    formAddCoTeacher.put(route("lessons.update", props.selectedLesson.id), {
      onSuccess: () => {
        // Réinitialiser le formulaire ou actualiser les données ici
        formAddCoTeacher.reset(); // Reset le formulaire après l'envoi
        // Vous pourriez vouloir fermer le menu déroulant ou afficher un message de succès ici
      },
    });
  }
};
const deleteLesson = (lessonId) => {
  if (confirm("Êtes-vous sûr de vouloir supprimer ce cours ?")) {
    Inertia.delete(route("lessons.destroy", lessonId), {
      preserveScroll: true,
      preserveState: false,
      onSuccess: () => {
        props.lessons = props.lessons.filter(
          (lessons) => lessons.id !== lessonId
        );
      },
    });
  }
};
</script>

<template>
  <AppLayout title="Liste des cours">
    <template #header>
      <h2 class="leading-tight">Liste des cours</h2>
    </template>
    <div class="pb-4">
      <Link
        :href="route('lessons.create')"
        class="flex items-center justify-center transition duration-300 ease-in-out px-6 py-3 border-[#1F2D55] border-2 rounded-lg hover:bg-[#1F2D55] hover:border-transparent text-center text-white shadow-sm bg-[#1F2D55]"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          fill="white"
          class="size-6 mr-2"
        >
          <path
            d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z"
          ></path>
        </svg>
        Ajouter un cours
      </Link>
    </div>
    <div class="mb-32">
      <!-- Navigation -->
      <div class="bg-white shadow sm:rounded-md mb-6">
        <ul class="flex divide-x divide-gray-200">
          <li
            class="flex-1 font-medium font-sans text-center py-4 hover:bg-[#1F2D55]/10"
            v-for="lesson in lessons"
            :key="lesson.id"
          >
            <Link
              class="cursor-pointer"
              :href="route('lessons.index', lesson.id)"
              >{{ lesson.name }}
            </Link>
          </li>
        </ul>
      </div>

      <!-- Contenu -->
      <div class="grid md:grid-cols-3 md:gap-6">
        <div class="col-span-3 bg-white shadow sm:rounded-md p-4">
          <div v-if="selectedLesson" class="space-y-4">
            <div
              class="bg-[#1F2D55] sm:rounded-md text-white px-6 py-2 flex justify-between items-center"
            >
              <h3 class="text-lg font-medium">
                {{ selectedLesson.name }}
              </h3>
            </div>

            <div class="grid md:grid-cols-1 md:gap-6">
              <div class="bg-white sm:rounded-md text-white px-6 py-4">
                <div class="flex justify-between items-center">
                  <h3
                    class="text-xl underline underline-offset-1 text-poppins font-bold text-[#1F2D55] mb-2"
                  >
                    Liste des élèves inscrits au cours :
                  </h3>
                  <Link
                    :href="route('lessons.addStudent', selectedLesson.id)"
                    class="flex items-center text-[#1F2D55] transition duration-300 ease-in-out"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24"
                      fill="#1F2D55"
                      class="size-6 my-2 mr-2 cursor-pointer"
                      @click="yourClickFunctionHere"
                    >
                      <path
                        d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z"
                      ></path>
                    </svg>
                    Ajouter un élève
                  </Link>
                </div>

                <div
                  class="flex space-x-4 items-center text-black mx-6 py-1"
                  v-for="student in studentslist"
                  :key="(student.id)"
                >
                  <p>
                    - {{ student.firstname }}
                    {{ student.lastname }}
                  </p>
                  <Link
                    :href="
                      route('students.note', {
                        courseId: selectedLesson.id,
                        studentId: student.id,
                      })
                    "
                    class="ml-4 text-xs p-2 bg-[#1F2D55] hover:scale-105 transition duration-300 ease-in-out text-white rounded-lg"
                  >
                    Evaluer
                  </Link>
                </div>
              </div>
              <div class="bg-gray-400 h-px w-full my-2 mb-8"></div>
              <div class="bg-white sm:rounded-md text-white px-6">
                <div class="flex justify-between items-center">
                  <h3
                    class="text-xl text-[#1F2D55] underline underline-offset-1 text-poppins font-bold mb-2 flex items-center justify-between"
                  >
                    Liste des AA de {{ selectedLesson.name }} :
                  </h3>
                  <Link
                    :href="route('aas.edit', selectedLesson.id)"
                    class="flex items-center text-[#1F2D55] transition duration-300 ease-in-out"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      viewBox="0 0 24 24"
                      fill="#1F2D55"
                      class="w-6 h-6 mr-2"
                    >
                      <path
                        d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z"
                      ></path>
                    </svg>
                    Modifier les AA
                  </Link>
                </div>

                <div
                  class="flex space-x-4 items-center p- sm:p-6"
                  v-for="aaa in aa"
                  :key="aaa.id"
                >
                  <p>
                    <span class="font-bold text-[#62BFC1] pr-4">{{
                      aaa.name
                    }}</span>
                    <span class="text-gray-500 italic">{{
                      aaa.description
                    }}</span>
                  </p>
                </div>
                <div class="flex flex-col items-end justify-end">
                  <div class="justify-center items-center">
                    <DangerButton @click="deleteLesson(selectedLesson.id)">
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
                    <div
                      v-if="selectedLesson && !selectedLesson.second_user_id"
                      class="flex flex-col items-center justify-center space-y-4"
                    >
                      <button
                        @click="showAddTeacherInput = !showAddTeacherInput"
                        class="text-white mt-8 bg-[#1F2D55] mx-4 p-4 rounded-lg bold mb-4 hover:scale-105 transition duration-600 ease-in-out"
                      >
                        Ajouter un co-professeur
                      </button>
                    </div>
                    <div
                      v-if="showAddTeacherInput"
                      class="flex flex-col mt-2 pt-4 pb-4 text-white bg-slate-100 rounded-lg shadow-lg border-[#1F2D55] border justify-center items-center space-y-2 z-20 h-auto"
                    >
                      <select
                        @change="selectCoTeacher"
                        class="select rounded-lg mb-2 text-xs mx-4 text-start text-black"
                      >
                        <option value="" disabled selected
                          >Sélectionnez un professeur</option
                        >
                        <option
                          v-for="teacher in allTeachers"
                          :key="teacher.id"
                          :value="teacher.id"
                        >
                          {{ teacher.name }}
                        </option>
                      </select>
                      <button
                        @click="saveCoTeacher"
                        class="w-fit p-2 text-xs bg-[#1F2D55] rounded-lg"
                      >
                        Valider
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div v-else class="text-gray-500">
            Sélectionnez un cours pour voir plus de détails.
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
