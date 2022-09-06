<script setup>

import {Head, useForm} from '@inertiajs/inertia-vue3'
import DivPostForm from '@/Pages/Posts/DivPostForm.vue'
import TopPage from '@/Components/TopPage.vue'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'

const props = defineProps({
    'post': Object
})

let form = useForm({
    title: props.post.title,
    description: props.post.description,
    text: props.post.text,
});

const submit = () => {
    if (route().current('editUnpublishedPost'))
        form.post('/unpublishedPostsUpdate/' + props.post.id);
    else
        form.post('/postsUpdate/' + props.post.id);
};

</script>

<template>

    <Head title="Create Post"/>

    <TopPage/>

    <BreezeAuthenticatedLayout>
        <template #header>

            <form class="ml-4 mt-50" @submit.prevent="submit">

                <DivPostForm v-model="form.title" name="Title" :error="form.title.error"/>
                <DivPostForm v-model="form.description" name="Description" :error="form.description.error"/>
                <DivPostForm v-model="form.text" name="Text" :error="form.text.error"/>

                <div class="mt-4 ">
                    <button class="ml-4 bg-red-300" :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing">
                        Save Changes
                    </button>
                    <br>
                </div>
            </form>
        </template>
    </BreezeAuthenticatedLayout>
</template>
