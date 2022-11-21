<script setup>
import { Link } from '@inertiajs/inertia-vue3';

import PanelLayout from "@/Layouts/PanelLayout.vue";
import Card from "@/Components/Card.vue"
import Button from "@/Components/Button.vue"

defineProps(['counts', 'applications'])
</script>
<template>
    <PanelLayout>
        <div class="flex justify-between items-start gap-4">
            <Card class="w-2/3">
                <template #header>
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-lg text-neutral-900">Job offers</span>
                        <Link :href="route('panel.posting.index')"><Button>Go to offers</Button></Link>
                    </div>
                </template>
                <div class="flex items-center divide-x divide-neutral-200">
                    <div class="flex-1 text-center py-4">
                        <Link :href="route('panel.posting.index', { status: 'published' })" class="text-lg font-semibold text-neutral-700 hover:underline">Published</Link>
                        <div class="text-2xl font-bold text-green-600">{{ counts.published }}</div>
                    </div>
                    <div class="flex-1 text-center py-4">
                        <Link :href="route('panel.posting.index', { status: 'expired' })" class="text-lg font-semibold text-neutral-700 hover:underline">Expired</Link>
                        <div class="text-2xl font-bold text-red-600">{{ counts.expired }}</div>
                    </div>
                    <div class="flex-1 text-center py-4">
                        <Link :href="route('panel.posting.index', { status: 'drafts' })" class="text-lg font-semibold text-neutral-700 hover:underline">Drafts</Link>
                        <div class="text-2xl font-bold text-indigo-600">{{ counts.draft }}</div>
                    </div>
                </div>
            </Card>
            <Card class="w-1/3">
                <template #header>
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-lg text-neutral-900">Applications</span>
                        <Link :href="route('panel.apply.index')"><Button>Go to applications</Button></Link>
                    </div>
                </template>
                <div class="divide-y divide-neutral-200">
                    <template v-for="apply in applications">
                        <div class="py-2 first:pt-0 last:pb-0 flex justify-between items-center">
                            <div>
                                <div class="font-semibold text-neutral-700">{{ apply.candidate.name }}</div>
                                <div class="text-sm text-neutral-500">{{ apply.job_offer.title }}</div>
                            </div>
                            <span class="px-2 py-0.5 rounded-full text-sm text-neutral-500 border border-neutral-200"> 2 days ago</span>
                        </div>
                    </template>
                </div>
            </Card>
        </div>
    </PanelLayout>
</template>
