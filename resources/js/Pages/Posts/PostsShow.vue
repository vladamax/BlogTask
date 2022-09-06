<script setup>

import {Head, Link} from '@inertiajs/inertia-vue3'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'

const props = defineProps({
    'posts': Array
})
</script>

<template>
    <Head title="Posts"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">

                <div v-if="posts[0]">
                    <ul>
                        <li class="hover:bg-gray-400 mt-7 " v-for="post in posts">

                            <Link v-if="route().current('myUnpublishedPosts')"
                                  :href="'/unpublishedPosts/' + post.id">
                                <b>{{ post.title }}</b>
                            </Link>
                            <Link v-else :href="'/posts/' + post.id">
                                <b>{{ post.title }}</b>
                            </Link>
                            <h1>{{ post.description }}</h1>

                            <div v-if="route().current('myUnpublishedPosts')">
                                <Link class="float-right"
                                      :href="'/unpublishedPostsDelete/' + post.id">Delete
                                </Link>
                                <Link class="float-right mr-5"
                                      :href="'/unpublishedPostsEdit/' + post.id">Edit
                                </Link>
                                <Link class="float-right mr-5"
                                      :href="'/unpublishedPosts/' + post.id">Publish
                                </Link>
                            </div>

                            <div v-else-if="route().current('myPosts')">
                                <Link class="float-right"
                                      :href="'/postsDelete/' + post.id">Delete
                                </Link>
                                <Link class="float-right mr-5"
                                      :href="'/postsEdit/' + post.id">Edit
                                </Link>
                            </div>
                        </li>
                    </ul>
                </div>

                <div v-else>
                    <div v-if="route().current('myPosts')">
                        <h2>You don't have any published posts...</h2>
                    </div>
                    <div v-else>
                        <h2>There are no posts published yet...</h2>
                    </div>
                </div>

            </h2>
        </template>
    </BreezeAuthenticatedLayout>
</template>
