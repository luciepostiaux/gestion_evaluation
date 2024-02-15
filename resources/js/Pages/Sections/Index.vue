<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";

const props = defineProps(["sections"]);
</script>

<template>
    <AppLayout title="Liste des sections">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Liste des sections
            </h2>
        </template>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8 space-y-12">
            <div class="md:grid md:grid-cols-3 md:gap-6 space-y-4 md:space-y-0">
                <ul
                    class="grid grid-cols-1 divide-y bg-white shadow sm:rounded-md md:col-span-2"
                >
                    <li
                        class="flex space-x-4 items-center p-4 sm:p-6"
                        v-for="section in sections"
                        :key="section.id"
                    >
                        <label class="cursor-pointer" :for="section.id">{{
                            section.name
                        }}</label>
                    </li>
                </ul>
            </div>
        </div>
    </AppLayout>
</template>
