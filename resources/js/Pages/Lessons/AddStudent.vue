<script setup>
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link, useForm } from "@inertiajs/vue3";
import { defineProps } from "vue";

const props = defineProps({
  lesson: Object,
  students: Array,
  studentsLessonList: Array,
});

const formAdd = useForm({
  _method: "POST",
  student_id: null,
  lesson_id: props.lesson.id,
});

const formDelete = useForm({
  _method: "DELETE",
  student_id: null,
  lesson_id: props.lesson.id,
});

const add = (id) => {
  formAdd.student_id = id;
  formAdd.post(route("lessons.AddStudentlesson"));
};
const remove = (id) => {
  formDelete.student_id = id;
  formDelete.post(route("lessons.DeleteStudentLesson"));
};
</script>

<template>
  <AppLayout title="Liste des élèves">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Liste des élèves
      </h2>
    </template>
    <div
      class="cursor-pointer w-fit bg-[#1F2D55] p-4 m-2 rounded-lg text-white hover:scale-105 transition duration-300 ease-in-out"
    >
      <Link :href="route('lessons.index', lesson.id)">{{ lesson.name }} </Link>
    </div>
    <div class="md:grid md:grid-cols-2 md:gap-6 mt-4">
      <!-- Première colonne pour tous les élèves -->
      <ul class="divide-y bg-white shadow sm:rounded-md">
        <h2
          class="flex font-poppins justify-center items-center text-lg space-x-4 p-4 sm:p-6 bg-[#1F2D55] text-white rounded-t-md"
        >
          Tous les élèves
        </h2>
        <li
          class="flex space-x-4 items-center p-4 sm:p-6"
          v-for="student in students"
          :key="student.id"
        >
          <PrimaryButton class="cursor-pointer" @click="add(student.id)">
            {{ student.firstname }} {{ student.lastname }}
          </PrimaryButton>
        </li>
      </ul>

      <!-- Deuxième colonne pour les élèves inscrits dans le cours -->
      <ul class="divide-y bg-white shadow sm:rounded-md">
        <h2
          class="flex font-poppins justify-center items-center text-lg space-x-4 p-4 sm:p-6 bg-[#1F2D55] text-white rounded-t-md"
        >
          Élèves inscrits au cours
        </h2>
        <li
          class="flex space-x-4 items-center p-4 sm:p-6"
          v-for="student in studentsLessonList"
          :key="student.id"
        >
          <SecondaryButton class="cursor-pointer" @click="remove(student.id)">
            {{ student.firstname }} {{ student.lastname }}
          </SecondaryButton>
        </li>
      </ul>
    </div>
  </AppLayout>
</template>
