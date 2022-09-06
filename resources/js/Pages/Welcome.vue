<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3'
import TopPage  from '@/Components/TopPage.vue'
import PostsShow from '@/Pages/Posts/PostsShow.vue'

const props = defineProps({
    posts : Object
})

</script>

<template>
    <Head title="Welcome" />

    <div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center sm:pt-0">
        <TopPage/>
        <PostsShow :posts="props.posts"/>
    </div>
</template>
