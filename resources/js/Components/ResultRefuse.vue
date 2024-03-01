<script setup>
import { ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
</script>
<template>
    <div>
        <h2>Résultat de l'ajournement</h2>
        <div class="my-6">
            <div class="border-white p-4">
                <div class="flex">
                    <!-- Rectangle de gauche -->
                    <div class="w-1/2 border pr-2 py-2">
                        <div class="flex items-center justify-center h-full">
                            <Link
                                :href="route('dashboard')"
                                class="flex items-center h-full"
                            >
                                <ApplicationMark class="block h-full w-auto" />
                            </Link>
                        </div>
                    </div>
                    <!-- Rectangle de droite -->
                    <div class="w-1/2 border pl-2 py-2 font-bold">
                        <p class="text-center">Rue de la Limite 6</p>
                        <p class="text-center">1300 Wavre</p>
                        <p class="text-center">010 22 20 26</p>
                    </div>
                </div>
            </div>

            <div class="border">
                <!-- Première ligne -->
                <div class="flex border-b h-12">
                    <div class="w-full border-r p-2 text-center">
                        <p class="text-black font-bold text-poppins text-xl">
                            Motivation d'une décision d'ajournement
                        </p>
                    </div>
                </div>

                <!-- Lignes suivantes -->
                <div class="flex h-12 border-b">
                    <div class="w-64 border-r p-2">
                        <span class="text-center font-bold"
                            >Année académique</span
                        >
                    </div>
                    <div class="w-3/4 p-2">
                        <p class="text-center">Colonne de droite</p>
                    </div>
                </div>
                <div class="flex h-12 border-b">
                    <div class="w-64 border-r p-2">
                        <span class="text-center font-bold"
                            >Date de l'épreuve</span
                        >
                    </div>
                    <div class="w-3/4 p-2">
                        <p class="text-center">Colonne de droite</p>
                    </div>
                </div>
                <div class="flex h-12 border-b">
                    <div class="w-64 border-r p-2">
                        <span class="text-center font-bold"
                            >Date de délibération</span
                        >
                    </div>
                    <div class="w-3/4 p-2">
                        <p class="text-center">Colonne de droite</p>
                    </div>
                </div>
                <div class="flex h-12 border-b">
                    <div class="w-64 border-r p-2">
                        <span class="text-center font-bold"
                            >UE - Intitulé + Code du DP</span
                        >
                    </div>
                    <div class="w-3/4 p-2">
                        <p class="text-center">Colonne de droite</p>
                    </div>
                </div>
                <!-- 6ème ligne -->
                <div class="flex h-12 border-b">
                    <div class="w-64 flex items-center justify-center border-r">
                        <input type="checkbox" class="mr-2" />
                        <p class="text-center">UE Déterminante</p>
                    </div>
                    <div class="w-64 flex items-center justify-center border-r">
                        <input type="checkbox" class="mr-2" />
                        <p class="text-center">Épreuve intégrée</p>
                    </div>
                    <div class="w-64 flex items-center justify-center">
                        <input type="checkbox" class="mr-2" />
                        <p class="text-center">Autre</p>
                    </div>
                </div>

                <!-- 7ème ligne -->
                <div class="flex h-12">
                    <div class="w-48 border-r p-2">
                        <span class="text-center font-bold pr-10"
                            >Étudiant.e
                        </span>
                    </div>
                    <div class="w-3/4 p-2 border-b">
                        <p class="text-center">Colonne de droite</p>
                    </div>
                </div>
                <div class="flex h-12">
                    <div class="w-48 border-r p-2">
                        <span class="text-center font-bold pr-10"> </span>
                    </div>
                    <div class="w-3/4 p-2 border-b">
                        <p class="text-center">Colonne de droite</p>
                    </div>
                </div>
            </div>

            <!-- Paragraphe avec une phrase en italique -->
            <p class="italic mt-4 mb-4">L'étudiant.e est <span class="font-bold underline">ajourné.e</span> pour le(s) motif(s) suivant(s) ¹ : </p>

            <!-- Dernier conteneur -->
            <div class="border">
    <!-- Lignes 1 à 5 -->
    <div class="flex border-b h-12">
        <div class="w-4/5 border-r p-2">
            <p class="text-sm">- Fraude, plagiat où non-citation des sources dans une épreuve certificative</p>
            <p class="italic text-sm" >Justification et explication :</p>
        </div>
        <div class="w-24 p-2">
            <p class="text-center"><input type="checkbox" class="mr-2" /></p>
        </div>
    </div>
    <!-- 6ème ligne -->
    <div class="flex border-b h-12">
        <div class="w-4/5 border-r p-2">
            <p class="text-center">Test</p>
        </div>
        <div class="w-24 p-2">
            <p class="text-center"><input type="checkbox" class="mr-2" /></p>
        </div>
    </div>
    <!-- 7ème ligne -->
    <div class="flex border-b h-12">
        <div class="w-4/5 border-r p-2">
            <p class="text-center">Absence valablement justifiée</p>
        </div>
        <div class="w-24 p-2">
            <p class="text-center"><input type="checkbox" class="mr-2" /></p>
        </div>
    </div>
    <!-- 8ème ligne -->
    <div class="flex border-b h-12">
        <div class="w-4/5 border-r p-2">
            <p class="text-center">Test</p>
        </div>
        <div class="w-24 p-2">
            <p class="text-center"><input type="checkbox" class="mr-2" /></p>
        </div>
    </div>
    <!-- 9ème ligne -->
    <div class="flex h-12">
        <div class="w-4/5 border-r p-2">
            <p class="text-center">Test</p>
        </div>
        <div class="w-24 p-2">
            <p class="text-center"><input type="checkbox" class="mr-2" /></p>
        </div>
    </div>
</div>

        </div>
    </div>
</template>
