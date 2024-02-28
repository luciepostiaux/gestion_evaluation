<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, defineProps } from "vue";
import InputError from "./InputError.vue";

const props = defineProps({
    lesson: Object,
    skills: Array,
    aas: Array,
});

const formAddAa = useForm({
    name: "",
    lesson_id: props.lesson.id, // Utilisation de lessonId reçu en prop
});

const formAddSkill = useForm({
    lesson_id: props.lesson.id,
    name: "",
});

const addSkill = () => {
    formAddSkill.post(route("skill.store"), {
        preserveScroll: true,
        onSuccess: () => {
            formAddSkill.reset("name");
        },
    });
};

const addAa = () => {
    formAddAa.post(route("aas.store"), {
        preserveScroll: true,
        onSuccess: () => {
            formAddAa.reset("name");
        },
    });
};

const submitAA = () => {
    console.log(props.lessonId);

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
</script>

<template>
    <div class="flex flex-wrap">
        <!-- Colonne pour le bouton Ajouter un AA -->
        <div class="w-full lg:w-1/4 p-4">
            <!-- <div class="mb-6">
                Bouton Ajouter un AA 
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
            </div> -->
        </div>

        <div class="w-full lg:w-1/4 p-4">
            <div class="bg-white shadow sm:rounded-md p-4">
                <div class="mb-6">
                    <div
                        class="block text-[#1F2D55] font-poppins text-base font-bold mb-2"
                    >
                        Acquis d'apprentissage :
                    </div>
                    <ul>
                        <li
                            v-for="aa in aas"
                            :key="aa.id"
                            class="mb-2 py-2 px-3 rounded text-gray-700 leading-tight"
                        >
                            {{ aa.name }}

                            <ul class="">
                                <li
                                    v-for="criteria in aa.criteria"
                                    class="font-semibold text-xs"
                                >
                                    {{ criteria.name }}
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <form @submit.prevent="addAa" class="">
                    <div class="mb-6">
                        <label
                            for="aaAdd"
                            class="block text-[#1F2D55] font-poppins text-base font-bold mb-2"
                            >Ajouter un acquis d'apprentissage :</label
                        >
                        <input
                            type="text"
                            id="aaAdd"
                            class="shadow border-[#62BFC1] rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-[#62BFC1]"
                            placeholder="Entrez l'acquis d'apprentissage"
                            v-model="formAddAa.name"
                        />
                        <InputError
                            :message="formAddAa.errors.name"
                            class="mt-2"
                        />
                    </div>
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            @click.prevent="addAa"
                            class="bg-[#62BFC1] font-poppins text-white text-base font-bold py-2 px-6 rounded"
                        >
                            Ajouter l'acquis d'apprentissage
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="w-full lg:w-1/4 p-4">
            <div class="bg-white shadow sm:rounded-md p-4">
                <div class="mb-6">
                    <div
                        class="block text-[#1F2D55] font-poppins text-base font-bold mb-2"
                    >
                        Critères de maîtrise :
                    </div>
                    <ul>
                        <li
                            v-for="skill in skills"
                            :key="skill.id"
                            class="mb-2 py-2 px-3 rounded text-gray-700 leading-tight"
                        >
                            {{ skill.name }}
                        </li>
                    </ul>
                </div>
                <form @submit.prevent="addSkill" class="">
                    <div class="mb-6">
                        <label
                            for="skillAdd"
                            class="block text-[#1F2D55] font-poppins text-base font-bold mb-2"
                            >Ajouter un critère de maîtrise :</label
                        >
                        <input
                            type="text"
                            id="skillAdd"
                            class="shadow border-[#62BFC1] rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-[#62BFC1]"
                            placeholder="Entrez le critère de maîtrise"
                            v-model="formAddSkill.name"
                        />
                        <InputError
                            :message="formAddSkill.errors.name"
                            class="mt-2"
                        />
                    </div>
                    <div class="flex justify-end">
                        <button
                            type="submit"
                            @click.prevent="addSkill"
                            class="bg-[#62BFC1] font-poppins text-white text-base font-bold py-2 px-6 rounded"
                        >
                            Ajouter le critère de maîtrise
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
