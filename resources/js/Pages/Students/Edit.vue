<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { defineProps } from "vue";

const props = defineProps(["student"]); // Assurez-vous que 'student' est bien passé en props à la page
const form = useForm({
    firstname: props.student.firstname,
    lastname: props.student.lastname,
    // Ajoutez d'autres champs si nécessaire
});

const updateStudent = () => {
    form.put(route("students.update", props.student.id), {
        preserveScroll: true,
        onSuccess: () => {
            // Redirigez ou effectuez d'autres actions au succès
        },
    });
};
</script>

<template>
    <AppLayout title="Modifier l'élève">
        <form @submit.prevent="updateStudent">
            <input
                v-model="form.firstname"
                type="text"
                placeholder="Prénom de l'élève"
            />
            <input
                v-model="form.lastname"
                type="text"
                placeholder="Nom de l'élève"
            />
            <!-- Ajoutez d'autres champs si nécessaire -->
            <button type="submit">Mettre à jour</button>
        </form>
    </AppLayout>
</template>
