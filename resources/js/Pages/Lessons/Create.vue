<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import FormLesson from "@/Components/FormLesson.vue";
const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    sections: {
        type: Array,
    },
});
</script>

<template>
    <AppLayout title="Ajout d'un cours">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ajout d'un cours
            </h2>
        </template>

        <FormLesson :sections="sections" />
    </AppLayout>
</template>
