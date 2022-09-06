<script setup>
import {Link} from "@inertiajs/inertia-vue3";
</script>

<template>
    <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>
    <Link :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</Link>
</template>
