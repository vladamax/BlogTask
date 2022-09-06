<script setup>

import {Head, useForm} from '@inertiajs/inertia-vue3'
import DivPostForm from '@/Pages/Posts/DivPostForm.vue'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import TopPage from '@/Components/TopPage.vue'

let form = useForm({
    title: '',
    description: '',
    text: '',
    image_id: ''
});
const submit = (() => {
    // fileForm.post('uploadFile');
    if (publish)
        form.post('createdPost');
    else
        form.post('/createUnpublishedPost');
});


function fileChange(e) {
    fileForm.file = e.target.files[0];
}

function changeText(e) {
    console.log('ovde sam '.fileForm.errors.message[0])
    form.image_id = fileForm.errors.message[0];
}

let publish = true;

function justCreate() {
    publish = false;
}

let fileForm = useForm({
    file: '',
    config: {
        headers: {
            'content-type': 'multipart/form-data'
        }
    },
    id: ''
});
</script>

<template>
    <Head title="Create Post"/>
    <TopPage/>

    <BreezeAuthenticatedLayout>

        <template #header>
            <form class="ml-4 mt-4" @submit.prevent="submit">

                <DivPostForm v-model="form.title" name="Title" :error="form.title.error"/>
                <DivPostForm v-model="form.description" name="Description" :error="form.description.error"/>
                <DivPostForm v-model="form.text" name="Text" :error="form.text.error"/>

                <Button class="ml-4 bg-red-400 mt-4 py-2 px-6" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
                    Publish
                </Button>

                <Button @click="justCreate()" class="ml-4 bg-red-400 mt-4 py-2 px-6"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save to my drafts
                </Button>
            </form>

        </template>
    </BreezeAuthenticatedLayout>
</template>
<!--        <input type="file" class="form-control" @change="fileChange">-->

<!--        <label class="mt-2" v-on:change="changeText" v-if="fileForm.errors.message" >{{ fileForm.errors.message[0] }}</label>-->
