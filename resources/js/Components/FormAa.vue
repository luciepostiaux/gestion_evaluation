<script setup>
import { useForm } from "@inertiajs/vue3";
import { ref, defineProps } from "vue";
import InputError from "./InputError.vue";

const isModalOpen = ref(false);
const currentAa = ref({});

const openEditAaModal = (aa) => {
    currentAa.value = aa;
    isModalOpen.value = true;
};

const props = defineProps({
    lesson: Object,
    skills: Array,
    aas: Array,
});
const submitAaEdit = () => {
    axios.post(route('aas.update', { id: currentAa.value.id }), {
        name: currentAa.value.name
    }).then(() => {
        isModalOpen.value = false;
        // You might want to refresh the list of AAs here or show a success message
    }).catch(error => {
        // Handle any errors, such as displaying validation messages
    });
};


const deleteAa = (aa) => {
    axios.delete(route('aas.destroy', { id: aa.id }));
};

const addCriteria = (aa) => {
    formAddCriteria.post(route('aas.criteria', { id: aa.id }));
};

const editCriteria = (criteria) => {
    window.location.href = route('criteria.edit', { id: criteria.id });
};

const deleteCriteria = (criteria) => {
    axios.delete(route('criteria.destroy', { id: criteria.id }));
};

const editSkill = (skill) => {
    window.location.href = route('skills.edit', { id: skill.id });
};

const deleteSkill = (skill) => {
    axios.delete(route('skills.destroy', { id: skill.id }));
};

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
<button @click="openEditAaModal(aa)">✐</button>
<button @click="deleteAa(aa)">🆇</button>
<button @click="addCriteria(aa)">+</button>


                            <ul class="">
                                <li
                                    v-for="criteria in aa.criteria"
                                    class="font-semibold text-xs"
                                >
                                    {{ criteria.name }}
                                    <button @click="editCriteria(criteria)">✐</button>
                                    <button @click="deleteCriteria(criteria)">🆇</button>


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
                            <button @click="editSkill(skill)">✐</button>
                            <button @click="deleteSkill(skill)">🆇</button>

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
                                                <input type="number" v-model="formAddSkill.score" placeholder="Entrez le score maximum">

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
    <Modal :show="isModalOpen" @close="isModalOpen = false">
    <template #default>
        <!-- Form for editing the AA -->
        <form @submit.prevent="submitAaEdit">
            <input v-model="currentAa.name" placeholder="Nom de l'acquis d'apprentissage" />
            <button type="submit">Submit</button>
        </form>
    </template>
</Modal>

</template>
