<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import FormLesson from "@/Components/FormLesson.vue";
</script>

<template>
    <AppLayout title="Ajout d'un cours">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ajout d'un cours
            </h2>
        </template>

        <FormLesson />
    </AppLayout>
</template>
