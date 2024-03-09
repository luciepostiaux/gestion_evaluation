<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ResultEvaluation from "@/Components/ResultEvaluation.vue";
import { Link } from "@inertiajs/vue3";
import { defineProps } from "vue";

const props = defineProps({
  lesson: Object,
  student: Object,
  aas: Array,
  skills: Array,
  aasWithStudentNotes: Array,
  skillsWithStudentNotes: Array,
  lessonStatus: Number, // Ajoutez cette ligne
});
</script>

<template>
  <AppLayout title="Fiche d'ajournement">
    <template #header>
      <h2 class="leading-tight">
        Evaluation {{ student.firstname }} {{ student.lastname }}
      </h2>
    </template>
    <ResultEvaluation
      :lesson="lesson"
      :student="student"
      :aas="aas"
      :skills="skills"
      :lessonStatus="lessonStatus"
    />
  </AppLayout>
</template>
