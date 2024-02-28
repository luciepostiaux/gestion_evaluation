<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import FormAa from "@/Components/FormAa.vue";
const props = defineProps({
    lesson: Object,
    skills: Array,
});
</script>

<template>
    <AppLayout title="Ajout des aa et critères">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ajout des aa et critères
            </h2>
        </template>

        <FormAa :lesson="props.lesson" :skills="props.skills" />
    </AppLayout>
</template>
