<script setup>
import { useForm } from "@inertiajs/vue3";

const emit = defineEmits(["close"]);

const props = defineProps({
    show: {
        type: Boolean,
        default: false,
    },
    sections: {
        type: Array,
    },
});

const close = () => {
    emit("close");
};

const form = useForm({
    name: null,
    section_id: null,
});

const submitLesson = () => {
    form.post(route("lessons.store"), {
        onSuccess: () => {
            form.name = null;
            form.section_id = null;
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
                @submit.prevent="submitLesson"
            >
                <div class="mb-6">
                    <label
                        for="name"
                        class="block text-[#1F2D55] font-poppins text-base font-bold mb-2"
                    >
                        Nom du cours
                    </label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        required
                        class="shadow border-[#62BFC1] rounded w-full mb-2 py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline focus:border-[#62BFC1]"
                        placeholder="Entrez le nom du cours"
                        v-model="form.name"
                    />
                </div>

                <div class="mb-6">
                    <label
                        for="section"
                        class="block text-[#1F2D55] font-poppins text-base font-bold mb-2"
                    >
                        Associé à une section
                    </label>
                    <select
                        id="section"
                        name="section_id"
                        required
                        class="shadow appearance-none border-[#62BFC1] rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-[#62BFC1] focus:shadow-outline focus:border-[#62BFC1]"
                        v-model="form.section_id"
                    >
                        <option value="" disabled>
                            Sélectionnez une section
                        </option>
                        <option
                            v-for="section in props.sections"
                            :key="section.id"
                            :value="section.id"
                        >
                            {{ section.name }}
                        </option>
                    </select>
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
