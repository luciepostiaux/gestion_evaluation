<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps(["section"]);
const form = useForm({ name: props.section.name });

const updateSection = () => {
    form.put(route("sections.update", props.section.id), {
        preserveScroll: true,
        onSuccess: () => Inertia.visit(route("sections.index")),
    });
};
</script>

<template>
    <AppLayout title="Modifier la section">
        <form @submit.prevent="updateSection">
            <input
                v-model="form.name"
                type="text"
                placeholder="Nom de la section"
            />
            <button type="submit">Mettre à jour</button>
        </form>
    </AppLayout>
</template>
