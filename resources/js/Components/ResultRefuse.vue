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
            <div class="w-1/2 border border-black pl-2 py-2 font-bold">
                <p class="text-center">Rue de la Limite 6</p>
                <p class="text-center">1300 Wavre</p>
                <p class="text-center">010 22 20 26</p>
            </div>
        </div>

        <!-- Bloc de données -->
        <div class="border border-black mt-4">
            <!-- Première ligne -->
            <div class="flex border-b border-black h-12">
                <div class="w-full border-r border-black p-2 text-center">
                    <p class="text-black font-bold text-poppins text-xl">
                        Motivation d'une décision de refus
                    </p>
                </div>
            </div>
            <!-- Lignes suivantes -->
            <div class="flex h-12 border-b border-black">
                <div class="w-64 border-r border-black p-2">
                    <span class="text-center font-bold">Année académique</span>
                </div>
                <div class="w-3/4 p-2">
                    <!-- Suppression du texte "Colonne de droite" -->
                </div>
            </div>
            <div class="flex h-12 border-b border-black">
                <div class="w-64 border-r border-black p-2">
                    <span class="text-center font-bold">Date de l'épreuve</span>
                </div>
                <div class="w-3/4 p-2">
                    <!-- Suppression du texte "Colonne de droite" -->
                </div>
            </div>
            <div class="flex h-12 border-b border-black">
                <div class="w-64 border-r border-black p-2">
                    <span class="text-center font-bold"
                        >Date de délibération</span
                    >
                </div>
                <div class="w-3/4 p-2">
                    <!-- Suppression du texte "Colonne de droite" -->
                </div>
            </div>
            <div class="flex h-12 border-b border-black">
                <div class="w-64 border-r border-black p-2">
                    <span class="text-center font-bold"
                        >UE - Intitulé + Code du DP</span
                    >
                </div>
                <div class="w-3/4 p-2">
                    <!-- Suppression du texte "Colonne de droite" -->
                </div>
            </div>
            <!-- 6ème ligne -->
            <div class="flex h-12 border-b border-black">
                <div
                    class="w-64 flex items-center justify-center border-r border-black"
                >
                    <input type="checkbox" class="mr-2" />
                    <p class="text-center">UE Déterminante</p>
                </div>
                <div
                    class="w-64 flex items-center justify-center border-r border-black"
                >
                    <input type="checkbox" class="mr-2" />
                    <p class="text-center">Épreuve intégrée</p>
                </div>
                <div class="w-64 flex items-center justify-center border-black">
                    <input type="checkbox" class="mr-2" />
                    <p class="text-center">Autre</p>
                </div>
            </div>
            <!-- 7ème ligne -->
            <div class="flex h-12 border-b border-black">
                <div class="w-48 border-r border-black p-2">
                    <span class="text-center font-bold pr-10">Étudiant.e </span>
                </div>
                <div class="w-3/4 p-2 border-b border-black">
                    <!-- Suppression du texte "Colonne de droite" -->
                </div>
            </div>
            <div class="flex h-12 border-b border-black">
                <div class="w-48 border-r border-black p-2">
                    <span class="text-center font-bold pr-10"> </span>
                </div>
                <div class="w-3/4 p-2 border-b border-black">
                    <!-- Suppression du texte "Colonne de droite" -->
                </div>
            </div>
        </div>

        <!-- Paragraphe avec une phrase en italique -->
        <p class="italic mt-4 mb-4">
            L'étudiant.e est
            <span class="font-bold underline">refusé.e</span> pour le(s)
            motif(s) suivant(s) ¹ :
        </p>

        <div class="border border-black">
            <!-- Lignes 1 à 5 -->
            <div class="flex border-b border-black" style="height: 200px">
                <!-- Modification de h-12 à h-16 -->
                <div class="w-4/5 border-r border-black p-2 flex-grow">
                    <p class="text-sm">
                        - Fraude, plagiat où non-citation des sources dans une
                        épreuve certificative de 2ème session
                    </p>
                    <p class="italic text-sm underline">
                        Justification et explication :
                    </p>
                </div>
                <div class="w-24 p-2 border-b border-black">
                    <input type="checkbox" class="mr-2" />
                </div>
            </div>
             <div class="flex border-b border-black" style="height: 200px">
                <!-- Modification de h-12 à h-16 -->
                <div class="w-4/5 border-r border-black p-2 flex-grow">
                    <p class="text-sm">
                        - Fraude, plagiat où non-citation des sources dans une
                        épreuve certificative de 1ère session
                    </p>
                    <p class="italic text-sm underline">
                        Justification et explication :
                    </p>
                </div>
                <div class="w-24 p-2 border-b border-black">
                    <input type="checkbox" class="mr-2" />
                </div>
            </div>
            <!-- 6ème ligne -->
            <div class="flex h-12 border-b border-black mb-4">
                <div class="w-4/5 border-r border-black p-2 flex-grow">
                    <p class="text-sm">
                        Absence(s) à l' (aux)
                        épreuve(s) de 2ème session
                    </p>
                </div>
                <div class="w-24 p-2 border-b border-black">
                    <input type="checkbox" class="mr-2" />
                </div>
            </div>
            <div class="flex h-12 border-b border-black mb-4">
                <div class="w-4/5 border-r border-black p-2 flex-grow">
                    <p class="text-sm">
                        Non-justification de l'absence à l'épreuve de 1ère session
                    </p>
                </div>
                <div class="w-24 p-2 border-b border-black">
                    <input type="checkbox" class="mr-2" />
                </div>
            </div>
            <div class="flex h-12 border-b border-black mb-4">
                <div class="w-4/5 border-r border-black p-2 flex-grow">
                    <p class="text-sm">
                       Acquis d'apprentissage non atteint(s)
                    </p>
                </div>
                <div class="w-24 p-2 border-b border-black">
                    <input type="checkbox" class="mr-2" />
                </div>
            </div>
        </div>
        <div class="border-t border-black my-4"></div>

        <div class="w-full">
            <!-- Utilisation de w-full pour correspondre à la largeur des conteneurs précédents -->
            <p class="text-sm italic">
                ¹ : Base légale : Décret du 16/1991 organisant l'enseignement de
                promotion sociale - AGCF portant règlement général des études de
                l'enseignement secondaire de promotion sociale du 02/09/2015 -
                AGCF portant règlement général des études de l'enseignement
                supérieur de promotion sociale de type court et de régime 1 du
                20/07/1993 - Circulaire n°4711 du 09/05/2019 - ROI de l'IFOSUP
            </p>
        </div>
    </div>
    <div class="my-6 border border-black p-4">
        <div class="flex">
            <!-- Rectangle de gauche -->
            <div class="w-1/2 border border-black pr-2 py-2">
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
            <div class="w-1/2 border border-black pl-2 py-2 font-bold">
                <p class="text-center">Rue de la Limite 6</p>
                <p class="text-center">1300 Wavre</p>
                <p class="text-center">010 22 20 26</p>
            </div>
            </div>
        </div>

        <div class="border border-black">
            <!-- Lignes 1 à 5 -->
            <div class="flex " style="height: 200px">
                <!-- Modification de h-12 à h-16 -->
                <div class="w-4/5 border-r border-black p-2 flex-grow">
                    <p class="italic text-sm underline">
                        Justification et explication : (+joindre la grille d'évaluation)
                    </p>
                </div>
                <div class="w-24 p-2 ">

                </div>
            </div>
        </div>



        <div>
            <!-- Utilisation de w-full pour correspondre à la largeur des conteneurs précédents -->
            <p class="my-4 underline">Voies de recours interne² : </p>
            <p class=" italic">Tout élève a le droit d'introduire un recours écrit contre les décisons de fefus prises à son égard par le conseil des études. Ce recours doit impérativement mentionner les irrégularités précises qui le motivent.</p>
            <p class=" italic">L'introduction d'un recours interne ne peut se faire que sur base d'une plainte écrite adressée par pli recommandé au chef d'établissement ou réceptionné(e) par celui-ci contre accusé de réception. Cette plainte doit être déposée au plus tard le 4ème jour calendrier qui suit la publication des résultats.</p>
            <p class="unerline  italic">L'adresse où la plainte doit être expédiée ou déposée est la suivante : </p>
              <div >
            <!-- Lignes 1 à 5 -->
            <div class="flex justify-between items-center h-12 px-40 pt-10 pb-60">
    <p class="font-bold ">Le Conseil des Études (nom + titre)</p>
    <p class="font-bold">La Direction</p>
</div>


                </div>
            </div>
            <div class="border border-black"></div>
            <p class="text-sm italic">
                ² : Uniquement en cas de refus dans une unité d'enseignement ou à <span class="font-bold">l'épreuve intégrée</span> (cfr. Base légale)
            </p>


</template>
