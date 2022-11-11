<script setup>
import SiteLayout from "@/Layouts/SiteLayout.vue";
import { Link } from '@inertiajs/inertia-vue3';

defineProps(['jobOffers'])
</script>

<template>
    <SiteLayout>
        <div class="p-4 mb-8 border border-neutral-300 bg-neutral-100">
            <h2 class="mb-4 text-center text-2xl font-bold">Top Remote Job Board. Salary in Every Ad.</h2>
            <div class="mb-4">
                <input type="search" class="w-full" placeholder="title">
            </div>
            <div>
                <input type="text" placeholder="category">
                <input type="text" placeholder="salary">
                <input type="text" placeholder="level">
            </div>
        </div>

        <div class="mb-8">
            <div class="mb-2 font-bold text-2xl">Offers of the day</div>
            <div class="bg-neutral-50 border border-neutral-300 divide-y divide-neutral-300">
                <template v-for="jobOffer in jobOffers">
                    <div class="px-4 py-2 flex justify-between items-center hover:bg-neutral-200">
                        <div>
                            <div class="text-xl">{{ jobOffer.title }}</div>
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

        <div class="mb-8">
            <div class="mb-2 font-bold text-2xl">Newest offers</div>
            <div class="bg-neutral-50 border border-neutral-300 divide-y divide-neutral-300">
                <template v-for="n in 12">
                    <div class="px-4 py-2 flex justify-between items-center hover:bg-neutral-200">
                        <div>
                            <div>job offer {{ n }}</div>
                            <div>company</div>
                        </div>
                        <div>
                            <template v-for="n in 3">
                                <span class="mr-2">category {{ n }}</span>
                            </template>
                        </div>
                        <div>
                            <span>15000 - 20000 PLN</span>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        <div class="mb-8 text-center">
            <Link :href="route('site.jobs.index')" class="mx-auto px-4 py-2 inline-flex items-center gap-2 border border-neutral-300">
                See all offers
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                    <path fill-rule="evenodd" d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z" clip-rule="evenodd" />
                </svg>
            </Link>
        </div>
    </SiteLayout>
</template>
