<script setup>
import { ref } from "vue";
import { Head, Link, router } from "@inertiajs/vue3";
import ApplicationMark from "@/Components/ApplicationMark.vue";
</script>

<template>
    <div class="my-6 border border-black p-4">
        <div class="flex">
            <!-- Rectangle de gauche -->
            <div class="w-1/2 border border-black pr-2 py-2">
                <div class="flex items-left justify-left h-full">
                    <Link
                        :href="route('dashboard')"
                        class="flex items-center h-full"
                    >
                        <ApplicationMark class="block h-full w-auto" />
                    </Link>
                </div>
            </div>
            <!-- Rectangle de droite -->
            <div class="w-1/2 border border-black pl-2 py-2 font-light">
                <p class="text-left">Nom et prénom de l'étudiante :</p>
                <p class="text-left">Section :</p>
                <p class="text-left">Unité d'enseignement :</p>
                <p class="text-left">Code de l'UE :</p>
                <p class="text-left">Nom du/des chargé(e)s de cours :</p>
                <p class="text-left">Année scolaire :</p>
            </div>
        </div>

        <!-- Bloc de données -->
        <div class="border border-black">
            <!-- Première ligne -->
            <div class="flex border-b border-black h-12">
                <div class="w-full border-r border-black p-2">
                    <p class="text-black font-bold text-poppins items-left">
                        POUR ATTEINDRE LE SEUIL DE REUSSITE, L'ETUDIANT.E
                        PROUVERA QU'IL/ELLE EST CAPABLE DE :
                    </p>
                </div>
            </div>
            <!-- Lignes suivantes -->
            <div class="flex h-12 border-b border-black">
                <div class="w-full border-r border-black p-2">
                    <span class="text-center italic text-gray-500"
                        >Indiquez ici le chapeau repris au dessus des acquis
                        d'apprentissage dans le dossier pédagogique</span
                    >
                </div>
                <div
                    class="w-1/6 flex justify-end items-center border-r border-black p-2 font-bold"
                >
                    <span>Acquis</span>
                </div>
                <div
                    class="w-1/6 flex justify-end items-center border-r border-black p-2 font-bold"
                >
                    <span>Non acquis</span>
                </div>
            </div>
            <div class="flex h-12 border-b border-black">
                <div class="w-1/2 border-r border-black p-2">
                    <span class="text-center h-8 font-bold underline"
                        >AA :
                    </span>
                </div>
                <div class="w-1/2 border-r border-black p-2">
                    <span class="text-center italic"> </span>
                </div>
                <div
                    class="w-1/6 flex justify-end items-center border-r border-black p-2 font-bold"
                >
                    <span></span>
                </div>
                <div
                    class="w-1/6 flex justify-end items-center border-r border-black p-2 font-bold"
                >
                    <span></span>
                </div>
            </div>

            <div class="flex h-12 border-b border-black">
                <div class="w-1/2 border-r border-black p-2">
                    <span class="text-center font-bold underline"> </span>
                </div>
                <div class="w-1/2 border-r border-black p-2">
                    <span class="text-center italic"> </span>
                </div>
                <div
                    class="w-1/6 flex justify-end items-center border-r border-black p-2 font-bold"
                >
                    <span></span>
                </div>
                <div
                    class="w-1/6 flex justify-end items-center border-r border-black p-2 font-bold"
                >
                    <span></span>
                </div>
            </div>

            <div class="flex h-12 border-b border-black">
                <div class="w-1/2 border-r border-black p-2">
                    <span class="text-center font-bold underline"> </span>
                </div>
                <div class="w-1/2 border-r border-black p-2">
                    <span class="text-center italic"> </span>
                </div>
                <div
                    class="w-1/6 flex justify-end items-center border-r border-black p-2 font-bold"
                >
                    <span></span>
                </div>
                <div
                    class="w-1/6 flex justify-end items-center border-r border-black p-2 font-bold"
                >
                    <span></span>
                </div>
            </div>

            <div class="flex h-12 border-b border-black">
                <div class="w-1/2 border-r border-black p-2">
                    <span class="text-center font-bold underline"> </span>
                </div>
                <div class="w-1/2 border-r border-black p-2">
                    <span class="text-center italic"> </span>
                </div>
                <div
                    class="w-1/6 flex justify-end items-center border-r border-black p-2 font-bold"
                >
                    <span></span>
                </div>
                <div
                    class="w-1/6 flex justify-end items-center border-r border-black p-2 font-bold"
                >
                    <span></span>
                </div>
            </div>

            <div class="flex h-12 border-b border-black">
                <div class="w-1/2 border-r border-black p-2">
                    <span class="text-center font-bold underline"> </span>
                </div>
                <div class="w-1/2 border-r border-black p-2">
                    <span class="font-bold">
                        Décision pour le AA : tous les critères
                    </span>
                </div>
                <div
                    class="w-1/6 flex justify-end items-center border-r border-black p-2 font-bold"
                ></div>
                <div
                    class="w-1/6 flex justify-end items-center border-r border-black p-2 font-bold"
                >
                    <span></span>
                </div>
            </div>

            <div class="grid grid-cols-3">
                <div class="border border-black p-2 text-center">
                    <p class="font-bold">Tout les AA sont "aquis"</p>
                    <p class="font-bold">REUSSITE</p>
                    <p class="font-light italic">→ Voir degré de maîtrise</p>
                </div>
                <div class="border border-black p-2 text-center">
                    <p class="font-bold">
                        Au moins un AA est non-aquis
                        <span class="font-light italic text-xs"
                            >(en 1ère session)</span
                        >
                    </p>
                    <p class="font-bold">AJOURNEMENT</p>
                    <p class="font-light italic">
                        → Voir justification ajournement
                    </p>
                </div>
                <div class="border border-black p-2 text-center">
                    <p class="font-bold">
                        Au moins un AA est non-aquis
                        <span class="font-light italic text-xs"
                            >(en 2ème session)</span
                        >
                    </p>
                    <p class="font-bold">REFUS</p>
                    <p class="font-light italic">→ Voir justification refus</p>
                </div>
            </div>
            <div class="flex border-b border-black h-12">
                <div class="w-full border-r text-center border-black p-2">
                    <p class="text-black font-bold text-poppins items-center">
                        DEGRE DE MAISTRISE (> ou = à 50%)
                    </p>
                </div>
            </div>
        </div>

        <div class="border border-black mt-6">
            <div class="w-full border-r text-left border-black p-2">
                <p class="text-black font-bold text-poppins items-left">
                    0 = Acquis, 1 = Bien, 2 = TB, 3 = TTB, 4 = Excellent, 5 =
                    Parfait
                </p>
            </div>
            <div class="grid grid-cols-3">
                <div class="border border-black p-2 text-left">
                    <span class="font-bold underline">Critères</span>
                    <span
                        class="font-light under italic mx-1 text-gray-600 text-xs"
                        >Tels qu'au DP</span
                    >
                </div>
                <div class="border border-black p-2 text-left">
                    <span class="font-bold underline">Indicateurs : </span>
                    <span
                        class="font-light under italic mx-1 text-gray-600 text-xs"
                        >(des indicateurs de réussite, pour chacun des critères,
                        PEUVENT êtres ajoutés par le chargé de cours)</span
                    >
                </div>
                <div class="border border-black p-2 text-left">
                    <p class="font-bold underline">Niveau de maîtrise :</p>
                </div>
            </div>

            <div class="grid grid-cols-3">
                <div class="border border-black p-2 text-left">
                    <p>N°1 :</p>
                </div>
                <div class="border border-black p-2 text-left">
                    <p></p>
                </div>
                <div class="border border-black p-2 text-left">
                    <p></p>
                </div>
            </div>

            <div class="grid grid-cols-3">
                <div class="border border-black p-2 text-left">
                    <p>N°2 :</p>
                </div>
                <div class="border border-black p-2 text-left">
                    <p></p>
                </div>
                <div class="border border-black p-2 text-left">
                    <p></p>
                </div>
            </div>

            <div class="grid grid-cols-3">
                <div class="border border-black p-2 text-left">
                    <p>N°3 :</p>
                </div>
                <div class="border border-black p-2 text-left">
                    <p></p>
                </div>
                <div class="border border-black p-2 text-left">
                    <p></p>
                </div>
            </div>

            <div class="grid bg-gray-300 grid-cols-3">
                <div class="border border-black p-2 font-bold text-left">
                    <p>RESULTAT FINAL :</p>
                </div>
                <div
                    class="border border-black p-2 text-xs font-bold text-left"
                >
                    <p>
                        TOUS les AA sont atteint et le degré de maîtrise permet
                        de calculer la côte suivante (>50%)
                    </p>
                </div>
                <div class="border border-black p-2 text-center font-bold">
                    <p>/100</p>
                </div>
            </div>

            <div class="w-full border-r text-left border-black p-2">
                <p
                    class="text-black font-bold text-poppins items-left mb-8 underline"
                >
                    Date :
                </p>
                <p
                    class="text-black font-bold mb-20 text-poppins items-left underline"
                >
                    Signature du/des chargé(e)/s de cours :
                </p>
            </div>
        </div>
    </div>
</template>
