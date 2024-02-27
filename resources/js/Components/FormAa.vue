<script setup>
import { useForm } from "@inertiajs/vue3";

const form = useForm({
    name: null,
    description: null,
});
const submitClasse = () => {
    submit(route("sections.store"), {
        onSuccess: () => {
            form.name = null;
            form.description = null;
            form.aacriteria = null;
            form.criteria = null;
            form.indicateur = null;
            close();
        },
    });
};
</script>
<template>
    <div class="px-6 py-4">
        <div class="flex justify-center items-center">
            <form
                class="bg-white shadow sm:rounded-md p-8 text-sm text-gray-600 w-full max-w-xl"
                @submit.prevent="submitClasse"
            >
                <div class="mb-6">
                    <div class="flex justify-center items-center">
                        <h3
                            class="text-xl text-[#62BFC1] text-center underline underline-offset-1 text-poppins font-bold mb-2"
                        >
                            Acquis d'apprentissage
                        </h3>
                        <span
                            class="text-gray-400 no-underline ml-2 italic font-light"
                        >
                            0 à 50%</span
                        >
                    </div>
                    <label
                        for="name"
                        class="block text-[#1F2D55] font-poppins text-base font-bold mb-2"
                    >
                        Nom du AA :
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        required
                        class="shadow border-[#62BFC1] rounded w-full mb-2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-[#62BFC1]"
                        placeholder="Entrez le nom du AA"
                        v-model="form.name"
                    />
                </div>

                <div class="mb-6">
                    <label
                        for="description"
                        class="block text-[#1F2D55] font-poppins text-base font-bold mb-2"
                    >
                        Critère du AA :
                    </label>
                    <input
                        type="text"
                        id="aacriteria"
                        name="aacriteria"
                        required
                        class="shadow border-[#62BFC1] rounded w-full mb-2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-[#62BFC1]"
                        placeholder="Entrez le critère"
                        v-model="form.aacriteria"
                    />
                </div>
                <div class="flex justify-between mx-8 mb-4">
                    <a
                        href="#"
                        class="flex items-center text-[#1F2D55] font-bold transition duration-300 ease-in-out"
                        @click="addCritere"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="w-6 h-6 mr-2"
                        >
                            <path
                                d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z"
                            />
                        </svg>
                        Ajouter un AA
                    </a>

                    <a
                        href="#"
                        class="flex items-center text-[#1F2D55] font-bold transition duration-300 ease-in-out"
                        @click="addAA"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="w-6 h-6 mr-2"
                        >
                            <path
                                d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z"
                            />
                        </svg>
                        Ajouter un critère
                    </a>
                </div>

                <div class="bg-gray-400 h-px w-full my-2 mb-8"></div>
                <!-- Barre de séparation -->

                <div class="flex justify-center items-center">
                    <h3
                        class="text-xl text-[#62BFC1] text-center underline underline-offset-1 text-poppins font-bold mb-2"
                    >
                        Critères
                    </h3>
                    <span
                        class="text-gray-400 no-underline ml-2 italic font-light"
                    >
                        50 à 100%
                    </span>
                </div>

                <div class="mb-6">
                    <label
                        for="description"
                        class="block text-[#1F2D55] font-poppins text-base font-bold mb-2"
                    >
                        Nom du critère :
                    </label>
                    <input
                        type="text"
                        id="aacriteria"
                        name="aacriteria"
                        required
                        class="shadow border-[#62BFC1] rounded w-full mb-2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-[#62BFC1]"
                        placeholder="Entrez le nom du critère"
                        v-model="form.criteria"
                    />
                </div>
                <div class="mb-6">
                    <label
                        for="description"
                        class="block text-[#1F2D55] font-poppins text-base font-bold mb-2"
                    >
                        Indicateurs de réussite:
                    </label>
                    <input
                        type="text"
                        id="aacriteria"
                        name="aacriteria"
                        required
                        class="shadow border-[#62BFC1] rounded w-full mb-2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-[#62BFC1]"
                        placeholder="Entrez l'indicateur de réussite"
                        v-model="form.indicateur"
                    />
                </div>
                <div class="flex justify-between mx-8">
                    <a
                        href="#"
                        class="flex items-center text-[#1F2D55] font-bold transition duration-300 ease-in-out"
                        @click="addCritere"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="w-6 h-6 mr-2"
                        >
                            <path
                                d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z"
                            />
                        </svg>
                        Ajouter un critère
                    </a>

                    <a
                        href="#"
                        class="flex items-center transition text-[#1F2D55] font-bold duration-300 ease-in-out"
                        @click="addAA"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"
                            fill="currentColor"
                            class="w-6 h-6 mr-2"
                        >
                            <path
                                d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z"
                            />
                        </svg>
                        Ajouter un indicateur
                    </a>
                </div>
                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="bg-[#62BFC1] mt-4 font-poppins text-white text-base font-bold py-2 px-6 rounded"
                    >
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
