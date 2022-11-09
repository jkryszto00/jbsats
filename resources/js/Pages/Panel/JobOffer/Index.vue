<script setup>
import PanelLayout from "@/Layouts/PanelLayout.vue";
import { Link } from '@inertiajs/inertia-vue3';
import {defineProps} from "vue";

defineProps(['jobOffers'])
</script>

<template>
    <PanelLayout>
        <div class="p-4 bg-neutral-100 flex items-center justify-between">
            <span class="font-bold text-lg">Job offers</span>
            <Link :href="route('panel.posting.create')" class="bg-neutral-900 text-neutral-50 px-4 py-2">Post</Link>
        </div>
        <div class="mt-4 p-4 bg-neutral-100">
            <div class="mb-4">
                <input type="search" placeholder="search">
                <input type="text" placeholder="status">
            </div>
            <table class="w-full divide-y divide-neutral-200">
                <thead>
                    <tr>
                        <th class="py-2 text-left">Title</th>
                        <th class="text-center">Category</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Expired at</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200">
                    <template v-for="jobOffer in jobOffers">
                        <tr>
                            <td class="py-2 text-left">{{ jobOffer.title }}</td>
                            <td class="text-center"></td>
                            <td class="text-center">{{ jobOffer.status }}</td>
                            <td class="text-center">{{ (jobOffer.expired_at) ? jobOffer.expired_at : '-' }}</td>
                            <td class="text-right">
                                <button type="button" class="bg-blue-700 text-blue-50 px-2 py-1 text-sm mr-2">Publish</button>
                                <button type="button" class="bg-neutral-900 text-neutral-50 px-2 py-1 text-sm">More</button>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </PanelLayout>
</template>
