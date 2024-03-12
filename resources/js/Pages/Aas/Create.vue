<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import FormAa from "@/Components/FormAa.vue";
import { Link } from "@inertiajs/vue3";
const props = defineProps({
  lesson: Object,
  skills: Array,
  aas: Array,
});
</script>

<template>
  <AppLayout title="Ajout des aa et critères">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Ajout des aa et critères
      </h2>
    </template>
    <div
      class="cursor-pointer w-fit bg-[#1F2D55] p-4 m-2 rounded-lg text-white hover:scale-105 transition duration-300 ease-in-out"
    >
      <Link :href="route('lessons.index', lesson.id)">{{ lesson.name }} </Link>
    </div>

    <FormAa :lesson="props.lesson" :skills="props.skills" :aas="props.aas" />
  </AppLayout>
</template>
