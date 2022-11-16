<script setup>
import PanelLayout from "@/Layouts/PanelLayout.vue";
import Card from "@/Components/Card.vue";
import { Link } from '@inertiajs/inertia-vue3';

defineProps(['jobOffers'])
</script>
<template>
    <PanelLayout>
        <div class="mb-4 p-4 bg-neutral-100">
            <span class="font-bold text-xl">Candidates (2)</span>
        </div>
        <Card class="divide-y divide-neutral-200">
            <template v-for="jobOffer in jobOffers">
                <div class="py-2 flex justify-between items-center">
                    <Link :href="route('panel.apply.show', { jobOffer: jobOffer})" class="hover:underline">{{ jobOffer.title }}</Link>
                    <span>{{ jobOffer.applies_count }} candidates</span>
                </div>
            </template>
        </Card>
    </PanelLayout>
</template>
