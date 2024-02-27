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
        <template #breadcrumb>
            <!-- Contenu du Fil d'Ariane ici -->
            <nav aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li>
                        <Link
                            :href="route('dashboard')"
                            class="text-gray-500 hover:text-gray-700"
                        >
                            Accueil
                        </Link>
                    </li>
                    <li>/</li>
                    <li class="text-gray-500">
                        <Link
                            :href="route('lessons.index')"
                            class="text-gray-500 hover:text-gray-700"
                        >
                            Liste des cours
                        </Link>
                    </li>
                </ol>
            </nav>
        </template>
        <div
            class="md:grid md:grid-cols-2 md:gap-6 space-y-4 md:space-y-0 pb-8 flex items-center"
        >
            <h4 class="italic text-[#1F2D55]/50">
                Ici vous pouvez ajouter, modifier ou supprimer la liste de vos
                cours
            </h4>
            <Link
                :href="route('lessons.create')"
                class="flex items-center justify-center transition duration-300 ease-in-out border-[#1F2D55]/25 border-2 rounded-2xl hover:bg-[#1F2D55]/10 hover:border-transparent w-full text-center shadow-md bg-white space-x-4"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="#1F2D55"
                    class="size-10 my-2"
                >
                    >
                    <path
                        d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z"
                    ></path>
                </svg>
                <p class="text-lg">Ajouter un cours</p>
            </Link>
        </div>
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
