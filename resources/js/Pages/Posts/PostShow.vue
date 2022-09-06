<script setup>

import { Head, Link, useForm  } from '@inertiajs/inertia-vue3'
import moment from "moment/moment"
import Editor  from '@tinymce/tinymce-vue'
import TopPage  from '@/Components/TopPage.vue'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'

const props = defineProps({
    'post' : Object,
    'comments' : Object,
    'can' : Object
})

let form = useForm({
    post_id: props.post[0].id,
    text: ''
});

const submit = () => {
    form.post('/createdComment');
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

function format_date(value){
    if (value) {
        let timestamp = moment(String(value)).format('DD.MM.YYYY');

        if(moment(timestamp).fromNow().includes('years'))
        {
            return 'Posted on ' + timestamp;
        }
        return 'Posted ' + moment(value).fromNow();
    }
}

</script>

<template>

    <Head title="Posts" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <TopPage/>
    <div class="display:flex flex-direction: column">
        <b>Author: </b>
        <label>{{ post[0].author.name }}</label><br><br>
        <b>Title: </b>
        <label>{{post[0].title}}</label><br><br>
        <b>Description: </b>
        <label>{{post[0].description}}</label><br><br>
        <b>Text: </b><br>
        <label class="bg-gray-400">{{post[0].text}}</label><br>

        <div class="mt-8">
        <b>{{format_date(post[0].created_at)}}</b><br>
    </div></div>

            <button  class="mt-4 px-6 bg-red-400" @click="publish()"> Publish </button>
<br><br>
            <Link  class="mt-4 bg-red-400" href="/"> Back to Posts </Link>

            <div v-if="!route().current('unpublishedPostsShow')">
    <p class="mt-8"><strong>COMMENTS </strong></p>
            <div class="bg-purple-300">
    <ul>
        <li  class="hover:bg-gray-400 mt-7 border-color: rgb(113 63 18);" v-for="comment in comments">


            <b>Comment: </b><br>
            <h1  v-html="comment.text"></h1><br>
            <b>Author: </b>
            <b> {{comment.author.name}}</b><br>
            <b>{{format_date(post[0].created_at)}}</b><br>
        </li>
    </ul>



    <div v-if="!route().current('myUnpublishedPosts') ">

        <form class="mt-4" @submit.prevent="submit">

            <div>
                <label for="name">Your comment:</Label>
                <editor v-model="form.text"
                        :init="{
        menubar:false,
        branding:false,
        statusbar:false
      }"
                />
                <label class="mt-2" :message="form.errors.text" />
            </div>
            <Button class="ml-4 bg-red-300" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Post Comment
            </Button>
        </form>
    </div>

    <div v-else>
        <label>
            <Link :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</Link>
            to comment
        </label>
    </div></div>
            </div>
        </template>
    </BreezeAuthenticatedLayout>
</template>
