<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import ResultRefuse from '@/Components/ResultRefuse.vue'
import { Link } from "@inertiajs/vue3";

</script>
<template>
    <AppLayout title="Fiche d'ajournement">
        <template #header>
            <h2 class="leading-tight">Fiche d'ajournement</h2>
        </template>
        <ResultRefuse />
    </AppLayout>
</template>
