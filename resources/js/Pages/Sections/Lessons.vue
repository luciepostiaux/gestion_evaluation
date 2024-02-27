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
                Cours de la section: {{ section.name }}
            </h2>
        </template>

        <div>
            <ul>
                <li v-for="lesson in lessons" :key="lesson.id">
                    {{ lesson.name }}
                </li>
            </ul>
        </div>
    </AppLayout>
</template>
