<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import FormClasse from "@/Components/FormClasse.vue";
import { Link } from "@inertiajs/vue3";
</script>

<template>
    <AppLayout title="Ajout d'une section">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ajout d'une section
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
                            :href="route('sections.index')"
                            class="text-gray-500 hover:text-gray-700"
                        >
                            Liste des sections
                        </Link>
                    </li>
                    <li>/</li>
                    <li class="text-gray-500">
                        <Link
                            :href="route('sections.create')"
                            class="text-gray-500 hover:text-gray-700"
                        >
                            Ajouter une section
                        </Link>
                    </li>
                </ol>
            </nav>
        </template>

        <FormClasse />
    </AppLayout>
</template>
