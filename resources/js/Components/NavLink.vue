<script setup>
import { computed } from "vue";
import { Link } from "@inertiajs/vue3";

const props = defineProps({
  href: String,
  active: Boolean,
});

const classes = computed(() => {
  return props.active
    ? "inline-flex items-center px-1 pt-1 border-b-2 border-white text-sm font-medium leading-5  focus:outline-none focus:border-white transition duration-150 ease-in-out scale-105"
    : "inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5  hover:scale-[104%] hover:text-slate-100 hover:border-white focus:outline-none focus:text-white focus:border-white transition duration-150 ease-in-out font-bold";
});
</script>

<template>
  <Link :href="href" :class="classes">
    <slot />
  </Link>
</template>
