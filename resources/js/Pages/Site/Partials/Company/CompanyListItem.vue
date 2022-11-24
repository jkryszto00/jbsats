<script setup>
import { Link } from '@inertiajs/inertia-vue3';
defineProps(['company'])
</script>
<template>
    <Link :href="route('site.companies.show', { company: company })" class="w-1/4 py-8 border rounded-lg shadow-sm transition-all hover:bg-neutral-50">
        <img :src="company.logo" :alt="company.name" class="mx-auto h-28 w-28 object-cover rounded-full">
        <div class="mt-8 mb-2 text-neutral-700 text-center font-medium">
            {{ company.name }}
        </div>
        <div class="text-sm text-neutral-500 text-center">
            {{ company.job_offers_count }} jobs offers
        </div>
    </Link>
</template>
