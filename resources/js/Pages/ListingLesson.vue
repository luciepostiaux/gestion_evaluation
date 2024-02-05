<script setup>
import FormLesson from "@/Components/FormLesson.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import { defineProps } from "vue";
const props = defineProps({
    lessons: Array,
});
</script>

<template>
    <AppLayout title="ListingLesson">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Liste des cours
            </h2>
        </template>
        <div class="max-w-md mx-auto">
            <ul id="liste" class="bg-white shadow-lg rounded-lg p-6">
                <li v-for="lesson in lessons" :key="lesson.id" class="p-2">
                    {{ lesson.name }}
                </li>
            </ul>
        </div>

        <Link :href="route('ListingLesson')">Ajouter un cours</Link>
        <div class="form_add_lesson">
            <FormLesson> </FormLesson>
        </div>
    </AppLayout>
</template>
