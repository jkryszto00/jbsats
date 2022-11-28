<script setup>
import { Link } from '@inertiajs/inertia-vue3';

import PanelLayout from "@/Layouts/PanelLayout.vue";
import Card from "@/Components/Card.vue";

defineProps(['model'])
</script>
<template>
    <PanelLayout>
        <Card title="Candidates">
            <div class="divide-y divide-neutral-200">
                <template v-for="jobOffer in model.job_offers">
                    <div class="py-2 first:pt-0 last:pb-0 flex justify-between items-center">
                        <Link :href="route('panel.apply.show', { jobOffer: jobOffer})" class="font-semibold text-neutral-900 hover:underline">{{ jobOffer.title }}</Link>
                        <span class="px-2 py-0.5 rounded-full text-sm text-neutral-500 border border-neutral-200">{{ jobOffer.applies_count }} candidates</span>
                    </div>
                </template>
            </div>
        </Card>
    </PanelLayout>
</template>
