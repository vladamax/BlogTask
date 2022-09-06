<script setup>
import {useFormatDate} from "@/Composables/useFormatDate";

let {formatDate} = useFormatDate();

const props = defineProps({
    'post': Object
})

</script>

<template>
    <div class="display:flex flex-direction: column">
        <b>Author: </b>
        <label>{{ post['author']['name'] }}</label><br><br>
        <b>Title: </b>
        <label>aa{{ post['text'] }}aa</label><br><br>
        <b>Description: </b>
        <label>{{ post['description'] }}</label><br><br>
        <b>Text: </b><br>
        <label class="bg-gray-400">{{ post['text'] }}</label><br><br>
        <div v-if="post['image']">
            <b>Image: </b><br>
            <img :src="post['image']" class="object-scale-down h-auto w-auto">
        </div>
        <div class="mt-8">
            <b>{{ formatDate(post['created_at']) }}</b><br>
        </div>
    </div>
</template>
