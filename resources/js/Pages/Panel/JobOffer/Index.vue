<script setup>
import PanelLayout from "@/Layouts/PanelLayout.vue";
import { Link } from '@inertiajs/inertia-vue3';
import {defineProps, ref, watch} from "vue";
import {Inertia} from "@inertiajs/inertia";
import {debounce} from "lodash";
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'

const props = defineProps(['statuses', 'filters', 'jobOffers'])

const filters = ref({
    title: props.filters.title,
    status: props.filters.status
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
        <div class="p-4 bg-neutral-100 flex items-center justify-between">
            <span class="font-bold text-lg">Job offers</span>
            <Link :href="route('panel.posting.create')" class="bg-neutral-900 text-neutral-50 px-4 py-2">Post</Link>
        </div>
        <div class="mt-4 p-4 bg-neutral-100">
            <div class="mb-4">
                <input type="search" v-model="filters.title" placeholder="search">
                <select v-model="filters.status" class="capitalize">
                    <option value="all">All</option>
                    <template v-for="status in statuses">
                        <option :value="status">{{ status }}</option>
                    </template>
                </select>
            </div>
            <table class="w-full divide-y divide-neutral-200">
                <thead>
                    <tr>
                        <th class="py-2 text-left">Title</th>
                        <th class="text-left">Category</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Expired at</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-neutral-200">
                    <template v-for="jobOffer in jobOffers">
                        <tr>
                            <td class="py-2 text-left">{{ jobOffer.title }}</td>
                            <td class="text-left">
                                <template v-for="category in jobOffer.categories">
                                    <span class="px-2 py-1 mr-2 bg-indigo-200 text-sm">{{ category.name }}</span>
                                </template>
                            </td>
                            <td class="text-center">{{ jobOffer.status }}</td>
                            <td class="text-center">{{ (jobOffer.expired_at) ? jobOffer.expired_at : '-' }}</td>
                            <td class="text-right">
                                <div class="flex justify-end">
                                    <Link v-if="jobOffer.status !== 'published'" :href="route('panel.posting.publish', { jobOffer: jobOffer })" method="patch" as="button" class="bg-blue-700 text-blue-50 px-2 py-1 text-sm mr-2">Publish</Link>
                                    <Menu as="div" class="relative">
                                        <MenuButton class="bg-neutral-900 text-neutral-50 px-2 py-1 text-sm">More</MenuButton>
                                        <MenuItems class="absolute z-10 right-0 mt-1 w-32 origin-top-right bg-white border border-neutral-300 shadow-md">
                                            <MenuItem v-slot="{ active }" class="px-2 py-0.5 hover:bg-neutral-100">
                                                <Link class="flex">Statistics</Link>
                                            </MenuItem>
                                            <MenuItem v-slot="{ active }" class="px-2 py-0.5 hover:bg-neutral-100">
                                                <Link :href="route('panel.posting.preview', { jobOffer: jobOffer })" class="flex">Preview</Link>
                                            </MenuItem>
                                            <MenuItem v-slot="{ active }" class="px-2 py-0.5 hover:bg-neutral-100">
                                                <Link class="flex">Edit</Link>
                                            </MenuItem>
                                            <MenuItem v-slot="{ active }" class="px-2 py-0.5 hover:bg-neutral-100">
                                                <Link :href="route('panel.posting.delete', { jobOffer: jobOffer })" as="button" method="delete" class="w-full flex">Delete</Link>
                                            </MenuItem>
                                        </MenuItems>
                                    </Menu>
                                </div>
                            </td>
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </PanelLayout>
</template>
