<script setup>
import { ref } from 'vue'
import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
} from '@headlessui/vue'

defineProps(['categories'])

const selectedCategories = ref([])
</script>

<template>
    <div class="p-4 mb-8 border border-neutral-300 bg-neutral-100">
        <h2 class="mb-8 text-center text-2xl font-bold">Top Remote Job Board. Salary in Every Ad.</h2>
        <div class="w-2/3 mx-auto">
            <div class="mb-4">
                <input type="search" class="w-full" placeholder="title">
            </div>
            <div class="flex justify-between gap-2">
                <Listbox v-model="selectedCategories" multiple>
                    <div class="relative flex-1">
                        <ListboxButton class="w-full text-left px-4 py-2 border border-neutral-300 bg-white cursor-pointer hover:bg-neutral-50">
                            category ({{ selectedCategories.length }})
                        </ListboxButton>
                        <ListboxOptions class="absolute max-h-40 overflow-y-auto w-full bg-white border border-neutral-300 divide-y divide-neutral-300">
                            <ListboxOption
                                v-slot="{ selected }"
                                v-for="category in categories"
                                :key="category.id"
                                :value="category"
                            >
                                <div class="px-4 py-2 cursor-pointer hover:bg-neutral-50">
                                    {{ category.name }}
                                </div>
                            </ListboxOption>
                        </ListboxOptions>
                    </div>
                </Listbox>
                <div class="flex-1 px-4 py-2 border border-neutral-300 bg-white cursor-pointer hover:bg-neutral-50">salary (0)</div>
                <div class="flex-1 px-4 py-2 border border-neutral-300 bg-white cursor-pointer hover:bg-neutral-50">level (0)</div>
                <div class="flex-1 px-4 py-2 border border-neutral-300 bg-white cursor-pointer hover:bg-neutral-50">contract (0)</div>
            </div>
        </div>
    </div>
</template>
