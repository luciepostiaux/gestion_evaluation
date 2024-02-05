<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Welcome from "@/Components/Welcome.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import FormStudent from "@/Components/FormStudent.vue";
import FormClasse from "@/Components/FormClasse.vue";
import FormLesson from "@/Components/FormLesson.vue";

import { Link } from "@inertiajs/vue3";
import { ref } from "vue";

const showStudentForm = ref(false);
const showClassForm = ref(false);
const showLessonForm = ref(false);

const openStudentForm = () => {
    showStudentForm.value = true;
};

const closeStudentForm = () => {
    showStudentForm.value = false;
};

const openClassForm = () => {
    showClassForm.value = true;
};

const closeClassForm = () => {
    showClassForm.value = false;
};

const openLessonForm = () => {
    showLessonForm.value = true;
};

const closeLessonForm = () => {
    showLessonForm.value = false;
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <Link :href="route('ListingLesson')">Liste des cours</Link>

        <Link :href="route('ListingStudent')">Liste des élèves</Link>

        <PrimaryButton @click="openStudentForm">Ajouter un élève</PrimaryButton>
        <PrimaryButton @click="openClassForm"
            >Ajouter une section</PrimaryButton
        >
        <PrimaryButton @click="openLessonForm">Ajouter un cours</PrimaryButton>

        <FormStudent
            v-if="showStudentForm"
            :show="showStudentForm"
            @close="closeStudentForm"
        ></FormStudent>

        <FormClasse
            v-if="showClassForm"
            :show="showClassForm"
            @close="closeClassForm"
        ></FormClasse>

        <FormLesson
            v-if="showLessonForm"
            :show="showLessonForm"
            @close="closeLessonForm"
        ></FormLesson>
    </AppLayout>
</template>
