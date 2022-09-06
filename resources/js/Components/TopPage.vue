<script setup>
import Unauthorized from '@/Components/Unauthorized.vue'
import Authorized from '@/Components/Authorized.vue'

</script>

<template>
    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">

        <div  v-if="$page.props.auth.user">
            <authorized/>
        </div>

        <div v-else>
            <unauthorized/>
        </div>
    </div>
</template>
