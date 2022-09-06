<script setup>
defineProps({
    modelValue: String,
    name: String,
    error: String,
})

defineEmits(['update:modelValue'])
</script>

<template>
    <div class="mt-3">
        <label>{{ name }}</label>
        <input :value="modelValue" type="text"
               class="mt-1 block w-100 rounded"
               @input="$emit('update:modelValue', $event.target.value)" required autofocus>
        <label class="mt-2" :message="error"/>
    </div>
</template>
