<script setup>
defineProps(['modelValue', 'error'])
defineEmits(['update:modelValue'])
</script>
<template>
    <input class="w-full block mb-1 px-2 py-1 text-neutral-700 border border-neutral-300 rounded-md shadow-sm" :class="[error ? 'border-red-400' : 'border-neutral-300']" :value="modelValue" @input="$emit('update:modelValue', $event.target.value)">
</template>
