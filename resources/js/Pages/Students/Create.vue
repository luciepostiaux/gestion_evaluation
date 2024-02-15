<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import FormStudent from "@/Components/FormStudent.vue";
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
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ajout d'un(e) élève
            </h2>
        </template>

        <FormStudent :sections="sections" />
    </AppLayout>
</template>
