<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import DangerButton from "@/Components/DangerButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/vue3";
import { Inertia } from "@inertiajs/inertia";

import { defineProps } from "vue";

const props = defineProps({
    sections: Array,
});

const editingSectionId = ref(null);
const form = useForm({
    name: "",
});

const startEditing = (section) => {
    editingSectionId.value = section.id;
    form.name = section.name;
};

const stopEditing = () => {
    editingSectionId.value = null;
};

const saveSection = (sectionId) => {
    form.put(route("sections.update", sectionId), {
        preserveScroll: true,
        onSuccess: () => stopEditing(),
    });
};

const deleteSection = (sectionId) => {
    if (confirm("Êtes-vous sûr de vouloir supprimer cette section ?")) {
        Inertia.delete(route("sections.destroy", sectionId), {
            preserveScroll: true,
            preserveState: false, // Vous pouvez essayer de changer cela si nécessaire
            onSuccess: () => {
                props.sections = props.sections.filter(
                    (section) => section.id !== sectionId
                );
            },
        });
    }
};
</script>

<template>
    <AppLayout title="Liste des sections">
        <template #header>
            <h2 class="leading-tight">Liste des sections</h2>
        </template>
        <Link
            :href="route('sections.create')"
            class="flex items-center justify-center transition duration-300 ease-in-out px-6 py-3 border-[#1F2D55]/25 border-2 rounded-lg hover:bg-[#1F2D55]/10 hover:border-transparent text-center shadow-sm bg-white"
        >
            <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="#1F2D55"
                class="size-6 mr-2"
            >
                <path
                    d="M11 11V7H13V11H17V13H13V17H11V13H7V11H11ZM12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20Z"
                ></path>
            </svg>
            Ajouter une section
        </Link>
        <div class="md:grid md:grid-cols-2 md:gap-6 space-y-4 md:space-y-0">
            <ul
                class="grid grid-cols-2 divide-y divide-x bg-white shadow sm:rounded-md md:col-span-2"
            >
                <li
                    class="flex items-center justify-between p-4 sm:p-6 hover:bg-[#1F2D55]/10"
                    v-for="section in sections"
                    :key="section.id"
                >
                    <div v-if="editingSectionId === section.id">
                        <input
                            v-model="form.name"
                            type="text"
                            class="input"
                            placeholder="Nom de la section"
                        />
                        <button
                            @click="saveSection(section.id)"
                            class="btn font-semibold text-xs"
                        >
                            Sauvegarder
                        </button>
                        <button
                            @click="stopEditing"
                            class="btn font-semibold text-xs"
                        >
                            Annuler
                        </button>
                    </div>
                    <div v-else>
                        <Link
                            :href="route('sections.lessons.index', section.id)"
                            class="w-full text-center"
                        >
                            {{ section.name }}
                        </Link>
                        <button
                            @click="startEditing(section)"
                            class="btn font-semibold text-xs"
                        >
                            Modifier
                        </button>
                    </div>
                    <div class="flex space-x-2">
                        <DangerButton @click="deleteSection(section.id)">
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24"
                                fill="#FFFFFF"
                                class="size-6"
                            >
                                <path
                                    d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 11H11V17H9V11ZM13 11H15V17H13V11ZM9 4V6H15V4H9Z"
                                ></path>
                            </svg>
                        </DangerButton>
                    </div>
                </li>
            </ul>
        </div>
    </AppLayout>
</template>
