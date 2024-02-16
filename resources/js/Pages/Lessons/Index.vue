<script setup>
import { ref } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
    lessons: Array,
    lesson: Object,
    students: Array,
    studentslist: Array,
    aa: Array,
    selectedLesson: Object,
});
</script>

<template>
    <AppLayout title="Liste des cours">
        <template #header>
            <h2 class="leading-tight">Liste des cours</h2>
        </template>

        <div class="">
            <!-- Navigation -->
            <div class="bg-white shadow sm:rounded-md mb-6">
                <ul class="flex divide-x divide-gray-200">
                    <li
                        class="flex-1 text-center py-4 hover:bg-[#1F2D55]/10"
                        v-for="lesson in lessons"
                        :key="lesson.id"
                    >
                        <Link
                            class="cursor-pointer"
                            :href="route('lessons.index', lesson.id)"
                            >{{ lesson.name }}</Link
                        >
                    </li>
                </ul>
            </div>

            <!-- Contenu -->
            <div class="grid md:grid-cols-3 md:gap-6">
                <div class="col-span-3 bg-white shadow sm:rounded-md p-6">
                    <div v-if="selectedLesson" class="space-y-4">
                        <h3 class="text-lg font-medium">
                            {{ selectedLesson.name }}
                        </h3>
                        <Link
                            :href="
                                route('lessons.addStudent', selectedLesson.id)
                            "
                            class="transition duration-300 ease-in-out"
                            >Ajouter un élève</Link
                        >
                        <div class="">
                            <h3>Liste des élèves inscrits au cours</h3>
                            <div
                                class="flex space-x-4 items-center p-4 sm:p-6"
                                v-for="student in studentslist"
                                :key="student.id"
                            >
                                <p>
                                    {{ student.firstname }}
                                    {{ student.lastname }}
                                </p>
                            </div>
                        </div>
                        <div class="">
                            <h3>Liste des AA</h3>
                            <div
                                class="flex space-x-4 items-center p-4 sm:p-6"
                                v-for="aaa in aa"
                                :key="aaa.id"
                            >
                                <p>
                                    {{ aaa.name }}
                                    {{ aaa.description }}
                                </p>
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
