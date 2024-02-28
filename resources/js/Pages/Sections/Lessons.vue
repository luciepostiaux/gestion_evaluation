<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import { defineProps } from "vue";

const props = defineProps({
    section: Object,
    lessons: Array,
});
</script>

<template>
    <AppLayout title="Cours de la section">
        <template #header>
            <h2 class="leading-tight">
                Liste des cours de la section: {{ section.name }}
            </h2>
        </template>
        <Link
                :href="route('lessons.create')"
                class="flex items-center justify-center transition duration-300 ease-in-out px-6 py-3 mb-6 border-[#1F2D55] border-2 rounded-lg hover:bg-[#1F2D55] hover:border-transparent text-center text-white shadow-sm bg-[#1F2D55]"
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

        <div class="bg-[#62BFC1] rounded-lg p-4  mb-4">
    <h2 class="text-white text-lg font-bold mb-2 pl-4">{{ section.name }}</h2>
    </div>
    <div>
            <ul class="pl-8">
                <li v-for="lesson in lessons" :key="lesson.id" >
                   - {{ lesson.name }}
                </li>
            </ul>
        </div>
    </AppLayout>
</template>
