<script setup>
import { useSlots } from "vue";

const slots = useSlots()
const props = defineProps(['title'])
</script>

<template>
    <div class="bg-white rounded-lg divide-y divide-neutral-200 shadow">
        <div v-if="slots.header || title" class="p-4">
            <div class="font-bold text-neutral-900 text-lg">{{ title }}</div>
            <slot name="header" />
        </div>
        <div class="p-4">
            <slot />
        </div>
        <div v-if="slots.footer" class="p-4">
            <slot name="footer" />
        </div>
    </div>
</template>
