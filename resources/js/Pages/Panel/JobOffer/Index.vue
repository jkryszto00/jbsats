<script setup>
import {ref, watch } from "vue";
import { debounce } from "lodash";
import { Inertia } from "@inertiajs/inertia";
import { Link } from '@inertiajs/inertia-vue3';
import { Menu, MenuButton, MenuItems, MenuItem, Listbox, ListboxButton, ListboxOption, ListboxOptions } from '@headlessui/vue'

import PanelLayout from "@/Layouts/PanelLayout.vue";
import Card from "@/Components/Card.vue";
import Button from "@/Components/Button.vue";
import Input from "@/Components/Form/Input.vue";

const prop = defineProps(['model'])

const filters = ref({
    title: prop.model.filters.title,
    status: prop.model.filters.status
})

watch(filters, debounce(() => {
    Inertia.get(route('panel.posting.index'), {
        title: filters.value.title,
        status: filters.value.status
    }, {
        preserveState: true,
        preserveScroll: true
    })
}, 250), {
    deep: true
})
</script>
<template>
    <PanelLayout>
        <Card>
            <template #header>
                <div class="flex items-center justify-between">
                    <span class="font-bold text-lg text-neutral-900">Job offers ({{ model.job_offers.length }})</span>
                    <Link :href="route('panel.posting.create')"><Button>Post offer</Button></Link>
                </div>
            </template>
            <div class="mb-8 flex gap-4">
                <Input type="search" v-model="filters.title" class="w-5/6" placeholder="Search..." />
                <Listbox as="div" v-model="filters.status" class="flex-1">
                    <div class="relative">
                        <ListboxButton class="w-full block mb-1 px-2 py-1 text-neutral-700 border border-neutral-300 rounded-md shadow-sm capitalize">
                            {{ filters.status }}
                        </ListboxButton>
                        <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                            <ListboxOptions class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                <ListboxOption value="All" v-slot="{ active, selected }">
                                    <li :class="[active ? 'text-neutral-900 bg-neutral-100' : 'text-neutral-700', 'relative cursor-default capitalize select-none py-2 pl-3 pr-9']">
                                        All
                                    </li>
                                </ListboxOption>
                                <ListboxOption as="template" v-for="status in model.statuses" :value="status" v-slot="{ active, selected }">
                                    <li :class="[active ? 'text-neutral-900 bg-neutral-100' : 'text-neutral-700', 'relative cursor-default capitalize select-none py-2 pl-3 pr-9']">
                                        {{ status }}
                                    </li>
                                </ListboxOption>
                            </ListboxOptions>
                        </transition>
                    </div>
                </Listbox>
            </div>
            <div class="divide-y divide-neutral-200">
                <template v-for="job in model.job_offers">
                    <div class="first:pt-0 py-2 flex items-center justify-between">
                        <div class="space-y-1">
                            <div class="font-semibold">{{ job.title }}</div>
                            <div class="flex gap-2">
                                <template v-for="category in job.categories">
                                    <span class="text-sm text-neutral-500">{{ category.name }}</span>
                                </template>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="space-y-2 text-right">
                                <div :class="[job.status === 'published' ? 'bg-green-100 text-green-900' : 'bg-gray-100 text-gray-900', 'inline capitalize px-2 py-0.5 text-sm font-semibold rounded-full']">{{ job.status }}</div>
                                <div class="flex items-center gap-2 text-sm text-neutral-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path fill-rule="evenodd" d="M5.75 2a.75.75 0 01.75.75V4h7V2.75a.75.75 0 011.5 0V4h.25A2.75 2.75 0 0118 6.75v8.5A2.75 2.75 0 0115.25 18H4.75A2.75 2.75 0 012 15.25v-8.5A2.75 2.75 0 014.75 4H5V2.75A.75.75 0 015.75 2zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75z" clip-rule="evenodd" />
                                    </svg>
                                    Closing on
                                    <span v-if="job.status === 'published'">{{ job.expired_at }}</span>
                                    <Link v-else :href="route('panel.posting.publish', { jobOffer: job })" as="button" method="patch" class="px-2 py-0.5 border border-neutral-200 transition-all hover:bg-neutral-50">Publish</Link>
                                </div>
                            </div>
                            <Menu as="div" class="relative">
                                <MenuButton class="p-1 text-neutral-500 rounded-full transition-all hover:bg-neutral-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                        <path d="M3 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM8.5 10a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM15.5 8.5a1.5 1.5 0 100 3 1.5 1.5 0 000-3z" />
                                    </svg>
                                </MenuButton>
                                <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                                    <MenuItems class="absolute right-0 z-10 w-36 origin-top-right divide-y divide-neutral-100 rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                        <div class="py-1">
                                            <MenuItem v-slot="{ active }">
                                                <Link :href="route('panel.posting.preview', { jobOffer: job })" :class="[active ? 'bg-neutral-50 text-neutral-900' : 'text-neutral-700', 'block px-2 py-1 text-sm']">Preview</Link>
                                            </MenuItem>
                                        </div>
                                        <div class="py-1">
                                            <MenuItem v-slot="{ active }">
                                                <Link :href="route('panel.posting.edit', { jobOffer: job })" :class="[active ? 'bg-neutral-50 text-neutral-900' : 'text-neutral-700', 'block px-2 py-1 text-sm']">Edit</Link>
                                            </MenuItem>
                                        </div>
                                        <div class="py-1">
                                            <MenuItem v-slot="{ active }">
                                                <Link :href="route('panel.posting.delete', { jobOffer: job })" as="button" method="delete" :class="[active ? 'bg-neutral-50 text-neutral-900' : 'text-neutral-700', 'w-full text-left px-2 py-1 text-sm']">Delete</Link>
                                            </MenuItem>
                                        </div>
                                    </MenuItems>
                                </transition>
                            </Menu>
                        </div>
                    </div>
                </template>
            </div>
        </Card>
    </PanelLayout>
</template>
