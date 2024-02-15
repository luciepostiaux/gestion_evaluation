<script setup>
import { Head, Link } from "@inertiajs/vue3";

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
});
</script>

<template>
    <Head title="Welcome" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen"
    >
        <div
            v-if="canLogin"
            class="sm:fixed sm:top-0 sm:end-0 p-6 text-end z-10"
        >
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                class=""
                >Dashboard</Link
            >

            <template v-else>
                <Link :href="route('login')" class="">Log in</Link>

                <Link v-if="canRegister" :href="route('register')" class=""
                    >Register</Link
                >
            </template>
        </div>
    </div>
</template>

<style></style>
