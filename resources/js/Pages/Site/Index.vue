<script setup>
import { Link } from '@inertiajs/inertia-vue3';

import SiteLayout from "@/Layouts/SiteLayout.vue";
import JobOfferFilter from "@/Pages/Site/Partials/JobOfferFilter.vue";
import JobsList from "@/Pages/Site/Partials/Job/JobsList.vue";

import Button from "@/Components/Button.vue";

defineProps(['model'])
</script>
<template>
    <SiteLayout>
        <template #hero-heading>Top Remote Job Board. Salary in Every Ad.</template>
        <template #hero-content>
            <JobOfferFilter
                :categories="model.categories"
                :levels="model.levels"
                :contracts="model.types"
            />
        </template>

        <JobsList
            class="my-8"
            title="Jobs of the day"
            :jobs="model.job_offers"
        />

        <JobsList
            class="my-8"
            title="Newest jobs"
            :jobs="model.job_offers"
        />

        <div class="mb-8 flex justify-center">
            <Link :href="route('site.jobs.index')">
                <Button class="flex items-center gap-2">
                    See all offers (352)
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                        <path fill-rule="evenodd" d="M2 10a.75.75 0 01.75-.75h12.59l-2.1-1.95a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.1-1.95H2.75A.75.75 0 012 10z" clip-rule="evenodd" />
                    </svg>
                </Button>
            </Link>
        </div>
    </SiteLayout>
</template>
