<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import SiteLayout from "@/Layouts/SiteLayout.vue";
import JobOfferFilter from "@/Pages/Site/Partials/JobOfferFilter.vue";

defineProps(['categories', 'jobOffers', 'jobOffersCount'])
</script>
<template>
    <SiteLayout>
        <JobOfferFilter
            :categories="categories"
        />

        <div class="mb-8">
            <div class="mb-2 font-bold text-2xl">Job offers ({{ jobOffersCount }})</div>
            <div class="bg-neutral-50 border border-neutral-300 divide-y divide-neutral-300">
                <template v-for="jobOffer in jobOffers">
                    <div class="px-4 py-2 flex justify-between items-center hover:bg-neutral-200">
                        <div>
                            <Link :href="route('site.jobs.show', { jobOffer: jobOffer })" class="text-xl">{{ jobOffer.title }}</Link>
                            <div>{{ jobOffer.company.name }}</div>
                        </div>
                        <div>
                            <template v-for="category in jobOffer.categories">
                                <span class="border border-neutral-300 px-2 py-1 mr-2">{{ category.name }}</span>
                            </template>
                        </div>
                        <div class="border border-neutral-300 px-2 py-1">
                            <span v-if="jobOffer.salary[0].from" class="uppercase">{{ jobOffer.salary[0].from }} - {{ jobOffer.salary[0].to }} {{ jobOffer.contract.currency }}</span>
                            <span v-else class="uppercase">{{ jobOffer.salary[0].exact }} {{ jobOffer.contract.currency }}</span>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="mb-8 text-center">
            <Link :href="route('site.jobs.index')" class="mx-auto px-4 py-2 inline-flex items-center gap-2 border border-neutral-300">
                Load more offers
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z" clip-rule="evenodd" />
                </svg>
            </Link>
        </div>
    </SiteLayout>
</template>
