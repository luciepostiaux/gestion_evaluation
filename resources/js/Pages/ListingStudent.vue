<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
</script>
<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Liste des élèves
            </h2>
        </template>
        <template>
            <Link :href="route('ListingStudent')">Ajouter un élève</Link>
            <div class="form_add_eleve hidden">
                <FormStudent> </FormStudent>
            </div>
        </template>
    </AppLayout>
</template>
