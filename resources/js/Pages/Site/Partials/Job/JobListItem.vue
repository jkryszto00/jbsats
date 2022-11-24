<script setup>
import { Link } from '@inertiajs/inertia-vue3';

defineProps(['job'])

const formatter = new Intl.NumberFormat('us-US')
</script>
<template>
    <div class="py-2 first:pt-0 last:pb-0 flex items-center justify-between">
        <div class="flex items-center gap-2">
            <img :src="job.company.logo" :alt="job.company.name" class="h-10 w-10 border border-neutral-200 rounded object-cover">
            <div>
                <Link :href="route('site.jobs.show', { jobOffer: job })" class="font-medium text-neutral-700 transition-all hover:text-neutral-900">{{ job.title }}</Link>
                <Link :href="route('site.companies.show', { company: job.company })" class="block text-sm text-neutral-500">{{ job.company.name }}</Link>
            </div>
        </div>
        <div class="flex gap-2">
            <template v-for="category in job.categories">
                <span class="px-2 py-0.5 rounded bg-indigo-100 text-indigo-700">{{ category.name }}</span>
            </template>
        </div>
        <div class="px-2 py-0.5 rounded bg-neutral-100 text-neutral-700">
            <span v-if="job.salary[0].from" class="uppercase">{{ formatter.format(job.salary[0].from) }} - {{ formatter.format(job.salary[0].to) }} {{ job.contract.currency }}</span>
            <span v-else class="uppercase">{{ formatter.format(job.salary[0].exact) }} {{ job.contract.currency }}</span>
        </div>
    </div>
</template>
