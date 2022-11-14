<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import SiteLayout from "@/Layouts/SiteLayout.vue";

defineProps(['companies', 'companiesCount'])
</script>

<template>
    <SiteLayout>
        <div class="mb-8">
            <div class="mb-2 font-bold text-2xl">Companies ({{ companiesCount }})</div>
            <div class="bg-neutral-50 border border-neutral-300 divide-y divide-neutral-300">
                <template v-for="company in companies">
                    <div class="p-4 flex justify-between items-center hover:bg-neutral-200">
                        <Link :href="route('site.companies.show', { company: company })" class="text-xl">{{ company.name }}</Link>
                        <span>Jobs ({{ company.jobOfferCount }})</span>
                    </div>
                </template>
            </div>
        </div>
    </SiteLayout>
</template>
