<script setup>

import { Head, Link } from '@inertiajs/inertia-vue3'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import PostsShow from '@/Pages/Posts/PostsShow.vue'

defineProps({
    'posts' : Object
})

</script>

<template>
    <PostsShow :posts="posts"/>
</template>
