<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, defineProps } from "vue";

const props = defineProps({
    lessonId: Number, // Assurez-vous que le type correspond à ce que vous attendez
});

const formAA = useForm({
    name: null,
    description: null,
    lesson_id: props.lessonId, // Utilisation de lessonId reçu en prop
});

const formCriteria = useForm({
    aacriteria: [{ id: Date.now(), value: "" }],
    lesson_id: props.lessonId, // Utilisation de lessonId reçu en prop
});

const addCriteria = () => {
    formCriteria.aacriteria.push({ id: Date.now(), value: "" });
};

const addAA = () => {
    formAA.reset(); // Réinitialise le formulaire AA
    formCriteria.reset(); // Réinitialise le formulaire des critères
};

const submitAA = () => {
    formAA.post(route("aas.store"), {
        preserveScroll: true,
        onSuccess: (page) => {
            formCriteria.aaId = page.props.id; // Assurez-vous que le backend renvoie l'ID de la nouvelle AA
        },
        onError: () => {
            // Traitez les erreurs ici
        },
    });
};

const submitCriteria = () => {
    formCriteria.post(route("criteria.store"), {
        preserveScroll: true,
        onSuccess: () => {
            formCriteria.reset("aacriteria"); // Réinitialise uniquement les critères
        },
        onError: () => {
            // Traitez les erreurs ici
        },
    });
};
</script>

<template>
    <div class="flex flex-wrap">
        <!-- Colonne pour le bouton Ajouter un AA -->
        <div class="w-full lg:w-1/4 p-4">
            <div class="mb-6">
                <!-- Bouton Ajouter un AA -->
                <a
                    href="#"
                    @click.prevent="addAA"
                    class="block text-right text-[#1F2D55] font-bold transition duration-300 ease-in-out mb-6"
                >
                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24"
                        fill="currentColor"
                        class="w-6 h-6 inline-block mr-2"
                    >
                        <path
                            d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z"
                        />
                    </svg>
                    Ajouter un AA
                </a>
            </div>
        </div>

        <!-- Colonne pour le formulaire d'ajout/modification d'un AA -->
        <div class="w-full lg:w-1/4 p-4">
            <form
                @submit.prevent="submitAA"
                class="bg-white shadow sm:rounded-md p-4"
            >
                <div class="mb-6">
                    <label
                        for="aa-name"
                        class="block text-[#1F2D55] font-poppins text-base font-bold mb-2"
                        >Nom du AA :</label
                    >
                    <input
                        type="text"
                        id="aa-name"
                        name="name"
                        required
                        class="shadow border-[#62BFC1] rounded w-full mb-2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-[#62BFC1]"
                        placeholder="Entrez le nom du AA"
                        v-model="formAA.name"
                    />
                </div>
                <div class="mb-6">
                    <label
                        for="aa-description"
                        class="block text-[#1F2D55] font-poppins text-base font-bold mb-2"
                        >Critères (Remplacer 'Description') :</label
                    >
                    <textarea
                        id="aa-description"
                        name="description"
                        class="shadow border-[#62BFC1] rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-[#62BFC1]"
                        placeholder="Entrez les critères"
                        v-model="formAA.description"
                    ></textarea>
                </div>
                <div class="flex justify-end">
                    <button
                        type="submit"
                        @click.prevent="submitAA"
                        class="bg-[#62BFC1] mt-4 font-poppins text-white text-base font-bold py-2 px-6 rounded"
                    >
                        Valider AA
                    </button>
                </div>
            </form>
        </div>

        <!-- Colonne pour le formulaire d'ajout de critères -->
        <div class="w-full lg:w-1/4 p-4">
            <form
                @submit.prevent="submitCriteria"
                class="bg-white shadow sm:rounded-md p-4"
            >
                <div
                    v-for="(criteria, index) in formCriteria.aacriteria"
                    :key="criteria.id"
                    class="mb-6"
                >
                    <label
                        for="'aacriteria' + index"
                        class="block text-[#1F2D55] font-poppins text-base font-bold mb-2"
                        >Critère du AA :</label
                    >
                    <input
                        type="text"
                        :id="'aacriteria' + index"
                        :name="'aacriteria' + index"
                        required
                        class="shadow border-[#62BFC1] rounded w-full mb-2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-[#62BFC1]"
                        placeholder="Entrez le critère"
                        v-model="criteria.value"
                    />
                    <!-- Ajoutez ici les champs pour les indicateurs, si nécessaire -->
                </div>
                <div class="flex justify-between">
                    <button
                        type="submit"
                        @click.prevent="submitCriteria"
                        class="bg-[#62BFC1] mt-4 font-poppins text-white text-base font-bold py-2 px-6 rounded"
                    >
                        Valider Critères
                    </button>
                </div>
            </form>
        </div>

        <!-- Colonne pour le bouton Ajouter un critère -->
        <div class="w-full lg:w-1/4 p-4">
            <a
                href="#"
                @click.prevent="addCriteria"
                class="block text-left text-[#1F2D55] font-bold transition duration-300 ease-in-out"
            >
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="currentColor"
                    class="w-6 h-6 inline-block mr-2"
                >
                    <path
                        d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z"
                    />
                </svg>
                Ajouter un critère
            </a>
        </div>
    </div>
</template>
