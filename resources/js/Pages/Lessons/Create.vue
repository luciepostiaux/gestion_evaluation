<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import FormLesson from "@/Components/FormLesson.vue";
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
    <AppLayout title="Ajout d'un cours">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ajout d'un cours
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
                            :href="route('lessons.index')"
                            class="text-gray-500 hover:text-gray-700"
                        >
                            Liste des cours
                        </Link>
                    </li>
                    <li>/</li>
                    <li class="text-gray-500">
                        <Link
                            :href="route('lessons.create')"
                            class="text-gray-500 hover:text-gray-700"
                        >
                            Ajouter un cours
                        </Link>
                    </li>
                </ol>
            </nav>
        </template>

        <FormLesson :sections="sections" />
    </AppLayout>
</template>
