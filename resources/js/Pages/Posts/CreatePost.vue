<script setup>
import {Head, useForm} from '@inertiajs/inertia-vue3'
import DivPostForm from '@/Components/DivPostForm.vue'
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import TopPage from '@/Components/TopPage.vue'

let form = useForm({
    title: '',
    description: '',
    text: '',
    image: '',
});
const submit = (() => {
    if (publish)
        form.post('createdPost');
    else
        form.post('/createUnpublishedPost');
});

function fileChange(e) {
    form.image = e.target.files[0];

    let reader = new FileReader();
    reader.readAsDataURL(form.image);

    reader.onload = e => {
        form.preview = e.target.result;
    };
}

let publish = true;

function justCreate() {
    publish = false;
}

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

                <input type="file" class="form-control" @change="fileChange">

                <label class="mt-2"
                       v-if="form.errors.message">{{ form.errors.message[0] }}</label>

                <Button class="ml-4 bg-red-400 mt-4 py-2 px-6" :class="{ 'opacity-25': form.processing }"
                        :disabled="form.processing">
                    Publish
                </Button>


                <Button @click="justCreate()" class="ml-4 bg-red-400 mt-4 py-2 px-6"
                        :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Save to my drafts
                </Button>
            </form>

            <form method="post" enctype="multipart/form-data">

            </form>

            <div v-if="form.preview">
                <img :src="form.preview"/>
            </div>
        </template>
    </BreezeAuthenticatedLayout>
</template>
