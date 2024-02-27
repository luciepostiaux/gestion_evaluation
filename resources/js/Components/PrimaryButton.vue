<script setup>
defineProps({
    type: {
        type: String,
        default: "submit",
    },
});
</script>

<template>
    <button
        :type="type"
        class="inline-flex items-center px-4 py-2 bg-[#62BFC1]/50 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-[#62BFC1]/50 focus:bg-[#62BFC1]/50 active:bg-[#62BFC1] focus:outline-none focus:ring-2 focus:ring-[#62BFC1] focus:ring-offset-2 transition ease-in-out duration-150"
    >
        <slot />
    </button>
</template>
