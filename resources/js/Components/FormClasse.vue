<script setup>
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
    form.post(route("sections.store"), {
        onSuccess: () => {
            form.name = null;
            close();
        },
    });
};
</script>
<template>
    <div class="px-6 py-4">
        <div class="flex justify-center items-center">
        <form class="bg-white shadow sm:rounded-md p-8 text-sm text-gray-600 w-full max-w-xl" @submit.prevent="submitClasse">

            <div class="mb-6">
                <label
                    for="name"
                    class="block text-[#1F2D55] font-poppins text-base font-bold mb-2"
                >
                    Nom de la section
                </label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    required
                    class="shadow border-[#62BFC1] rounded w-full mb-2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-[#62BFC1] "
                    placeholder="Entrez le nom de la section"
                    v-model="form.name"
                />
            </div>
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="bg-[#62BFC1] font-poppins text-white text-base font-bold py-2 px-6 rounded"
                >
                    Ajouter
                </button>
            </div>
        </form>
    </div>
    </div>
</template>
