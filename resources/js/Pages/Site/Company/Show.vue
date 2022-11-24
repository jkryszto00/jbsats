<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import SiteLayout from "@/Layouts/SiteLayout.vue";
import Card from "@/Components/Card.vue";

defineProps(['company'])

const formatter = new Intl.NumberFormat('us-US')
</script>
<template>
    <SiteLayout>
        <div class="my-8 flex justify-between items-start gap-4">
            <Card class="w-2/3">
                <template #header>
                    <div class="flex items-center gap-2">
                        <img :src="company.logo" :alt="company.name" class="rounded border object-cover h-12 w-12" />
                        <span class="font-bold text-lg text-neutral-900">{{ company.name }}</span>
                    </div>
                </template>

                <div class="flex">
                    <div class="flex-1 text-center space-y-1">
                        <div class="text-sm font-semibold text-neutral-500">Location</div>
                        <div class="inline-flex items-center gap-2 text-neutral-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819" />
                            </svg>
                            {{ company.location }}
                        </div>
                    </div>
                    <div class="flex-1 text-center space-y-1">
                        <div class="text-sm font-semibold text-neutral-500">Founded</div>
                        <div class="inline-flex items-center gap-2 text-neutral-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0l2.77-.693a9 9 0 016.208.682l.108.054a9 9 0 006.086.71l3.114-.732a48.524 48.524 0 01-.005-10.499l-3.11.732a9 9 0 01-6.085-.711l-.108-.054a9 9 0 00-6.208-.682L3 4.5M3 15V4.5" />
                            </svg>
                            {{ company.founded }}
                        </div>
                    </div>
                    <div class="flex-1 text-center space-y-1">
                        <div class="text-sm font-semibold text-neutral-500">Size</div>
                        <div class="inline-flex items-center gap-2 text-neutral-700">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                            </svg>
                            {{ company.size }}
                        </div>
                    </div>
                </div>

                <template #footer>
                    <div class="text-neutral-700" v-html="company.description"></div>
                </template>
            </Card>
            <Card class="w-1/3">
                <div class="divide-y divide-neutral-200">
                    <template v-for="job in company.job_offers">
                        <div class="py-2 flex justify-between first:pt-0 last:pb-0">
                            <Link :href="route('site.jobs.show', { jobOffer: job })" class="font-medium text-neutral-700">{{ job.title }}</Link>
                            <div class="px-2 py-0.5 rounded bg-neutral-100 text-neutral-700">
                                <span v-if="job.salary[0].from" class="uppercase">{{ formatter.format(job.salary[0].from) }} - {{ formatter.format(job.salary[0].to) }} {{ job.contract.currency }}</span>
                                <span v-else class="uppercase">{{ formatter.format(job.salary[0].exact) }} {{ job.contract.currency }}</span>
                            </div>
                        </div>
                    </template>
                </div>
            </Card>
        </div>
    </SiteLayout>
</template>
