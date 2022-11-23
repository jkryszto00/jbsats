<script setup>
import Card from '@/Components/Card.vue'
import JobListItem from "@/Pages/Site/Partials/Job/JobListItem.vue";

defineProps(['title', 'jobs'])
</script>
<template>
    <Card>
        <template #header>
            <div class="text-neutral-900 font-semibold text-xl">{{ title }}</div>
        </template>
        <div class="divide-y divide-neutral-200">
            <template v-for="job in jobs">
                <JobListItem :job="job" />
            </template>
        </div>
    </Card>
</template>
