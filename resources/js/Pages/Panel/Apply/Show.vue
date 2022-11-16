<script setup>
import PanelLayout from "@/Layouts/PanelLayout.vue";
import Card from "@/Components/Card.vue";
import {
    Disclosure,
    DisclosureButton,
    DisclosurePanel,
} from '@headlessui/vue'
import { Link } from '@inertiajs/inertia-vue3';

defineProps(['jobOffer', 'applies'])
</script>
<template>
    <PanelLayout>
        <div class="mb-4 p-4 bg-neutral-100">
            <span class="font-bold text-xl">{{ jobOffer.title }}</span>
        </div>
        <Card>
            <div class="divide-y divide-neutral-200">
                <template v-for="apply in applies">
                    <div>
                        <Disclosure>
                            <DisclosureButton class="w-full py-2 flex justify-between items-center">
                                <span>{{ apply.candidate.name }}</span>
                                <span class="capitalize px-2 py-1 capitalize text-sm rounded-full bg-neutral-200 text-neutral-600">{{ apply.status }}</span>
                            </DisclosureButton>
                            <DisclosurePanel class="divide-y divide-neutral-200">
                                <div class="pt-2 pb-4">
                                    <div>Name: {{ apply.candidate.name }}</div>
                                    <div>Email: {{ apply.candidate.email }}</div>
                                    <div>
                                        About
                                        <div>{{ apply.candidate.about }}</div>
                                    </div>
                                </div>
                                <div v-if="apply.status === 'applied'" class="py-4">
                                    <Link :href="route('panel.apply.reject', { apply: apply })" as="button" method="patch" class="text-neutral-500 hover:text-red-500 mr-4">Reject</Link>
                                    <Link :href="route('panel.apply.accept', { apply: apply })" as="button" method="patch" class="px-2 py-1 rounded bg-green-500 text-white hover:bg-green-600">Accept</Link>
                                </div>
                            </DisclosurePanel>
                        </Disclosure>
                    </div>
                </template>
            </div>
        </Card>
    </PanelLayout>
</template>
