<script setup>
import {onBeforeMount} from "vue"
import {useFormatDate} from "@/Composables/useFormatDate";

let {formatDate} = useFormatDate();

const props = defineProps({
    'post': Object
})
let blog = '';
onBeforeMount(() => {
    let blog = JSON.parse(JSON.stringify(props.post));
    console.log(blog);
    console.log(blog['text']);
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
        <label class="bg-gray-400">{{ post['text'] }}</label><br>

        <div class="mt-8">
            <b>{{ formatDate(post['created_at']) }}</b><br>
        </div>
    </div>
</template>
