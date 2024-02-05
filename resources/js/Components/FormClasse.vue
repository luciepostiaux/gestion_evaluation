<script setup>
import Modal from "./Modal.vue";
import { useForm } from "@inertiajs/vue3";

const emit = defineEmits(["close"]);

defineProps({
    show: {
        type: Boolean,
        default: false,
    },
});

const close = () => {
    emit("close");
};

const form = useForm({
    name: null,
});

const submitClasse = () => {
    form.post(route("section.store"), {
        onSuccess: () => {
            close();
        },
    });
};
</script>
<template>
    <Modal :show="show" @close="close">
        <div
            v-show="show"
            class="mb-6 rounded-lg overflow-hidden transform transition-all sm:w-full sm:mx-auto"
        >
            <!-- Bouton de fermeture en haut à droite -->
            <div class="flex justify-end p-2">
                <button
                    @click="close"
                    class="text-gray-400 hover:text-gray-600"
                >
                    <span class="text-2xl">&times;</span>
                </button>
            </div>
            <slot v-if="show" />
        </div>

        <div class="px-6 py-4">
            <form
                class="mt-4 text-sm text-gray-600"
                @submit.prevent="submitClasse"
            >
                <h1 class="text-lg font-bold mb-4">Ajouter une section</h1>

                <!-- Champ pour le nom -->
                <div class="mb-4">
                    <label
                        for="name"
                        class="block text-gray-700 text-sm font-bold mb-2"
                    >
                        Nom du cours
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Entrez le nom du cours"
                        v-model="form.name"
                    />
                </div>

                <!-- Bouton pour soumettre le formulaire -->
                <div class="flex items-center justify-between">
                    <button
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    >
                        Ajouter
                    </button>
                </div>
            </form>
        </div>
    </Modal>
</template>
