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
                Dashbaurord
            </h2>
        </template>

        <div class="flex flex-col items-center justify-center">
            <ul class="list-none m-0 p-0">
                <li class="mb-2">
                    <Link
                        :href="route('lessons.index')"
                        class="text-blue-600 hover:text-blue-700 transition duration-300 ease-in-out"
                    >
                        Liste des cours
                    </Link>
                </li>
                <li class="mb-2">
                    <Link
                        :href="route('students.index')"
                        class="text-blue-600 hover:text-blue-700 transition duration-300 ease-in-out"
                    >
                        Liste des élèves
                    </Link>
                </li>
                <li class="mb-2">
                    <Link
                        :href="route('sections.index')"
                        class="text-blue-600 hover:text-blue-700 transition duration-300 ease-in-out"
                    >
                        Liste des sections
                    </Link>
                </li>
            </ul>

            <ul class="list-none">
                <li>
                    <Link
                        :href="route('students.create')"
                        class="text-blue-600 hover:text-blue-700 transition duration-300 ease-in-out"
                        >Ajouter un élève</Link
                    >
                </li>
                <li>
                    <Link
                        :href="route('sections.create')"
                        class="text-blue-600 hover:text-blue-700 transition duration-300 ease-in-out"
                        >Ajouter une section</Link
                    >
                </li>
                <li>
                    <Link
                        :href="route('lessons.create')"
                        class="text-blue-600 hover:text-blue-700 transition duration-300 ease-in-out"
                        >Ajouter un cours</Link
                    >
                </li>
            </ul>
        </div>
    </AppLayout>
</template>
