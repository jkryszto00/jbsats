<script setup>
import PanelLayout from "@/Layouts/PanelLayout.vue";
import { Link } from '@inertiajs/inertia-vue3';

defineProps(['counts', 'applications'])
</script>

<template>
    <PanelLayout>
        <div class="flex justify-between gap-4">
            <div class="w-2/3 p-4 bg-neutral-100">
                <div class="pb-4 border-b border-neutral-200 flex items-center justify-between">
                    <span class="font-bold text-xl">Job offers</span>
                    <Link :href="route('panel.posting.index')" class="bg-neutral-900 text-neutral-50 px-4 py-2">Go to offers</Link>
                </div>
                <div class="pt-4 flex justify-between gap-4">
                    <div class="flex-1 p-10 border border-neutral-200 bg-green-100 text-center">
                        <span class="block text-lg">{{ counts.published }}</span>
                        <Link :href="route('panel.posting.index', { status: 'published' })" class="text-green-900 hover:underline">Published</Link>
                    </div>
                    <div class="flex-1 p-10 border border-neutral-200 bg-red-100 text-center">
                        <span class="block text-lg">{{ counts.expired }}</span>
                        <Link :href="route('panel.posting.index', { status: 'expired' })" class="text-red-900 hover:underline">Expired</Link>
                    </div>
                    <div class="flex-1 p-10 border border-neutral-200 bg-gray-200 text-center">
                        <span class="block text-lg">{{ counts.draft }}</span>
                        <Link :href="route('panel.posting.index', { status: 'drafts' })" class="text-gray-900 hover:underline">Drafts</Link>
                    </div>
                </div>
            </div>
            <div class="w-1/3 p-4 bg-neutral-100">
                <div class="pb-4 border-b border-neutral-200 flex items-center justify-between">
                    <span class="font-bold text-xl">Applications</span>
                    <Link class="bg-neutral-900 text-neutral-50 px-4 py-2">Go to applications</Link>
                </div>
                <div class="pt-4 divide-y divide-neutral-200">
                    <template v-for="application in applications">
                        <div class="py-2 flex justify-between items-center">
                            <div>
                                <div>{{ application.candidate.name }}</div>
                                <span class="text-sm">{{ application.job_offer.title }}</span>
                            </div>
                            <span class="px-2 py-1 capitalize text-sm rounded-full bg-neutral-200 text-neutral-600">{{ application.created_at }}</span>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </PanelLayout>
</template>
