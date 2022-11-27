<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'

import PanelLayout from "@/Layouts/PanelLayout.vue";
import Card from "@/Components/Card.vue";

defineProps(['model'])
</script>
<template>
    <PanelLayout>
        <Card>
            <template #header>
                <div class="mb-4 text-neutral-900 font-bold text-xl">{{ model.job_offer.title }}</div>
                <div class="flex -mb-4 gap-8">
                    <template v-for="status in model.statuses">
                        <Link href="" :data="{ status: status }" :class="[status === model.filters.status ? 'text-indigo-600 border-indigo-600' : 'text-neutral-700 hover:text-indigo-600 hover:border-indigo-600', 'capitalize inline-block pb-2 border-b-2 border-transparent ']">{{ status }}</Link>
                    </template>
                </div>
            </template>
            <div class="divide-y divide-neutral-200">
                <template v-for="apply in model.applies">
                    <Disclosure>
                        <DisclosureButton class="w-full py-2 flex justify-between items-center">
                            <div class="text-neutral-700">{{ apply.candidate.name }}</div>
                            <div v-if="apply.status === 'applied'" class="flex gap-2">
                                <Link :href="route('panel.apply.reject', { apply: apply })" as="button" method="patch" class="px-2 py-1 rounded text-red-500 transition-all hover:bg-red-50 mr-4">Reject</Link>
                                <Link :href="route('panel.apply.accept', { apply: apply })" as="button" method="patch" class="px-2 py-1 rounded bg-green-500 text-white hover:bg-green-600">Accept</Link>
                            </div>
                        </DisclosureButton>
                        <DisclosurePanel class="divide-y divide-neutral-200">
                            <div class="py-2 flex justify-between items-center">
                                <div class="w-1/3 text-sm font-medium text-neutral-500">
                                    Full name
                                </div>
                                <div class="w-2/3 text-neutral-700 font-medium">
                                    {{ apply.candidate.name }}
                                </div>
                            </div>
                            <div class="py-2 flex justify-between items-center">
                                <div class="w-1/3 text-sm font-medium text-neutral-500">
                                    Email address
                                </div>
                                <div class="w-2/3 text-neutral-700 font-medium">
                                    {{ apply.candidate.email }}
                                </div>
                            </div>
                            <div class="py-2 flex justify-between items-center">
                                <div class="w-1/3 text-sm font-medium text-neutral-500">
                                    About
                                </div>
                                <div class="w-2/3 text-neutral-700 font-medium">
                                    {{ apply.candidate.about }}
                                </div>
                            </div>
                            <div class="py-2 flex justify-between items-center">
                                <div class="w-1/3 text-sm font-medium text-neutral-500">
                                    Cv
                                </div>
                                <div class="w-2/3">
                                    <div class="w-1/2 px-4 py-2 flex items-center justify-between border rounded border-neutral-300">
                                        <div class="flex gap-4 items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5 text-neutral-500">
                                                <path d="M12.232 4.232a2.5 2.5 0 013.536 3.536l-1.225 1.224a.75.75 0 001.061 1.06l1.224-1.224a4 4 0 00-5.656-5.656l-3 3a4 4 0 00.225 5.865.75.75 0 00.977-1.138 2.5 2.5 0 01-.142-3.667l3-3z" />
                                                <path d="M11.603 7.963a.75.75 0 00-.977 1.138 2.5 2.5 0 01.142 3.667l-3 3a2.5 2.5 0 01-3.536-3.536l1.225-1.224a.75.75 0 00-1.061-1.06l-1.224 1.224a4 4 0 105.656 5.656l3-3a4 4 0 00-.225-5.865z" />
                                            </svg>
                                            <span class="text-neutral-700">{{ apply.candidate.cv.file_name }}</span>
                                        </div>
                                        <a :href="route('files.show', { name: apply.candidate.cv.name })" target="_blank" class="font-semibold text-indigo-600 transition-all hover:underline">Download</a>
                                    </div>
                                </div>
                            </div>
                        </DisclosurePanel>
                    </Disclosure>
                </template>
            </div>
        </Card>
    </PanelLayout>
</template>
