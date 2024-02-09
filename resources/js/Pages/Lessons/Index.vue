<script setup>
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps(["lessons"]);
const selectedLesson = ref(null); // État réactif pour le cours sélectionné

// Fonction pour mettre à jour le cours sélectionné
const selectLesson = (lesson) => {
    selectedLesson.value = lesson;
};
</script>

<template>
    <AppLayout title="Liste des cours">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Liste des cours
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 space-y-12">
            <div class="md:grid md:grid-cols-3 md:gap-6 space-y-4 md:space-y-0">
                <ul
                    class="grid grid-cols-1 divide-y bg-white shadow sm:rounded-md"
                >
                    <li
                        class="flex space-x-4 items-center p-4 sm:p-6"
                        v-for="lesson in lessons"
                        :key="lesson.id"
                        @click="selectLesson(lesson)"
                    >
                        <label class="cursor-pointer" :for="lesson.id">{{
                            lesson.name
                        }}</label>
                    </li>
                </ul>
                <div class="col-span-2 bg-white shadow sm:rounded-md p-6">
                    <div v-if="selectedLesson" class="space-y-4">
                        <h3 class="text-lg font-medium">
                            {{ selectedLesson.name }}
                            {{ selectedLesson.id }}
                        </h3>
                        <Link
                            :href="
                                route('lessons.addStudent', selectedLesson.id)
                            "
                            class="text-blue-600 hover:text-blue-700 transition duration-300 ease-in-out"
                            >Ajouter un élève</Link
                        >
                    </div>
                    <div v-else class="text-gray-500"></div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
