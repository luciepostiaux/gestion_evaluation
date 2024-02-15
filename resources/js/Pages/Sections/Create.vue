<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import FormClasse from "@/Components/FormClasse.vue";
</script>

<template>
    <AppLayout title="Ajout d'une section">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ajout d'une section
            </h2>
        </template>

        <FormClasse />
    </AppLayout>
</template>
