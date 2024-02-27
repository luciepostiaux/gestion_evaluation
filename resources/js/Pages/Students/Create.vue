<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import FormStudent from "@/Components/FormStudent.vue";
import { Link } from "@inertiajs/vue3";
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
        <template #breadcrumb>
            <!-- Contenu du Fil d'Ariane ici -->
            <nav aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li>
                        <Link
                            :href="route('dashboard')"
                            class="text-gray-500 hover:text-gray-700"
                        >
                            Accueil
                        </Link>
                    </li>
                    <li>/</li>
                    <li class="text-gray-500">
                        <Link
                            :href="route('students.index')"
                            class="text-gray-500 hover:text-gray-700"
                        >
                            Liste des élèves
                        </Link>
                    </li>
                    <li>/</li>
                    <li class="text-gray-500">
                        <Link
                            :href="route('students.create')"
                            class="text-gray-500 hover:text-gray-700"
                        >
                            Ajouter un(e) élève
                        </Link>
                    </li>
                </ol>
            </nav>
        </template>

        <FormStudent :sections="sections" />
    </AppLayout>
</template>
