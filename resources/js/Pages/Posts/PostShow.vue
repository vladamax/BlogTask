<script setup>

import {Head, Link, useForm} from '@inertiajs/inertia-vue3'
import Editor from '@tinymce/tinymce-vue'
import TopPage from '@/Components/TopPage.vue'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import PostInfo from '@/Components/PostInfo.vue'

import {useFormatDate} from "@/Composables/useFormatDate";

let {formatDate} = useFormatDate();

const props = defineProps({
    'post': Object,
    'comments': Object,
    'can': Object
})

let commentForm = useForm({
    post_id: props.post[0].id,
    text: ''
});

const submit = () => {
    commentForm.post('/createdComment');
};

function publish() {
    let publishForm = useForm({
        title: props.post[0].title,
        description: props.post[0].description,
        text: props.post[0].text,
        image_id: ''
    });
    publishForm.post('/createdPost');
}

</script>

<template>

    <Head title="Posts"/>

    <BreezeAuthenticatedLayout>
        <template #header>

            <TopPage/>

            <PostInfo :post="post[0]"/>

            <button v-if="route().current('unpublishedPostsShow')" class="mt-4 px-6 bg-red-400" @click="publish()">
                Publish
            </button>
            <br><br>
            <Link class="mt-4 bg-red-400" href="/"> Back to Posts</Link>

            <div v-if="!route().current('unpublishedPostsShow')">
                <p class="mt-8"><strong>COMMENTS </strong></p>
                <div class="bg-purple-300">
                    <ul>
                        <li class="hover:bg-gray-400 mt-7 border-color: rgb(113 63 18);" v-for="comment in comments">


                            <b>Comment: </b><br>
                            <h1 v-html="comment.text"></h1><br>
                            <b>Author: </b>
                            <b> {{ comment.author.name }}</b><br>
                            <b>{{ formatDate(post[0].created_at) }}</b><br>
                        </li>
                    </ul>


                    <div v-if="!route().current('myUnpublishedPosts') ">

                        <form class="mt-4" @submit.prevent="submit">

                            <div>
                                <label for="name">Your comment:</Label>
                                <editor v-model="commentForm.text"
                                        :init="{
        menubar:false,
        branding:false,
        statusbar:false
      }"
                                />
                                <label class="mt-2" :message="commentForm.errors.text"/>
                            </div>
                            <Button class="ml-4 bg-red-300" :class="{ 'opacity-25': commentForm.processing }"
                                    :disabled="commentForm.processing">
                                Post Comment
                            </Button>
                        </form>
                    </div>

                    <div v-else>
                        <label>
                            <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log
                                in
                            </Link>
                            to comment
                        </label>
                    </div>
                </div>
            </div>
        </template>
    </BreezeAuthenticatedLayout>
</template>
