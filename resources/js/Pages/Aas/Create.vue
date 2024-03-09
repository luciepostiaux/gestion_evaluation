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
    <Link class="cursor-pointer" :href="route('lessons.index', lesson.id)"
      >{{ lesson.name }}
    </Link>
    <FormAa :lesson="props.lesson" :skills="props.skills" :aas="props.aas" />
  </AppLayout>
</template>
