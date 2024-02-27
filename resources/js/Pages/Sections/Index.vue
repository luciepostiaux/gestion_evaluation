<script setup>
import DangerButton from "@/Components/DangerButton.vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/vue3";

const props = defineProps(["sections"]);

const deleteSection = (sectionId) => {
    if (confirm("Êtes-vous sûr de vouloir supprimer cette section ?")) {
        Inertia.delete(route("sections.destroy", sectionId), {
            preserveScroll: true,
            preserveState: true,
            onSuccess: () => {},
        });
    }
};
</script>

<template>
    <AppLayout title="Liste des sections">
        <template #header>
            <h2 class="leading-tight">Liste des sections</h2>
        </template>

        <div class="md:grid md:grid-cols-2 md:gap-6 space-y-4 md:space-y-0">
            <ul
                class="grid grid-cols-2 divide-y divide-x bg-white shadow sm:rounded-md md:col-span-2"
            >
                <li
                    class="flex items-center justify-between p-4 sm:p-6 hover:bg-[#1F2D55]/10"
                    v-for="section in sections"
                    :key="section.id"
                >
                    <label class="w-full text-center" :for="section.id">
                        {{ section.name }}
                    </label>
                    <div class="flex space-x-2">
                        <Link
                            :href="route('sections.edit', section.id)"
                            class="edit-button"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="#62BFC1"
                                viewBox="0 0 24 24"
                                class="size-6"
                            >
                                <!-- SVG path for edit icon -->
                                <path
                                    d="M6.41421 15.89L16.5563 5.74785L15.1421 4.33363L5 14.4758V15.89H6.41421ZM7.24264 17.89H3V13.6473L14.435 2.21231C14.8256 1.82179 15.4587 1.82179 15.8492 2.21231L18.6777 5.04074C19.0682 5.43126 19.0682 6.06443 18.6777 6.45495L7.24264 17.89ZM3 19.89H21V21.89H3V19.89Z"
                                ></path>
                            </svg>
                        </Link>

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
