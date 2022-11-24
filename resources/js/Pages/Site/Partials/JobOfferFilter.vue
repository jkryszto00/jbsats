<script setup>
import {ref, watch} from 'vue'
import { debounce } from "lodash";
import { Inertia } from "@inertiajs/inertia";
import { Listbox, ListboxButton, ListboxOptions, ListboxOption, Popover, PopoverButton, PopoverPanel } from '@headlessui/vue'

import Label from "@/Components/Form/Label.vue";
import Input from "@/Components/Form/Input.vue";

const props = defineProps(['categories', 'levels', 'contracts'])

const search = ref()
const salary = ref({
    min: 0,
    max: 100000
})
const selected = ref({
    category: [],
    level: [],
    contract: []
})

watch([search, salary, selected], debounce(() => {
    Inertia.get(route(route().current()), {
        title: search.value,
        category: selected.value.category.join(','),
        salary: `${salary.value.min},${salary.value.max}`,
        level: selected.value.level.join(','),
        contract: selected.value.contract.join(',')
    }, {
        preserveState: true,
        preserveScroll: true
    })
}, 250), {
    deep: true
})
</script>

<template>
    <div>
        <div class="mb-4">
            <Input type="search" v-model="search" class="py-2" placeholder="Search jobs..." />
        </div>
        <div class="flex justify-between gap-2">
            <Listbox as="div" class="w-1/4" v-model="selected.category" multiple>
                <div class="relative">
                    <ListboxButton class="w-full block mb-1 px-2 py-1 text-neutral-700 border border-neutral-300 rounded-md shadow-sm hover:bg-neutral-50">
                        Category ({{ selected.category.length }})
                    </ListboxButton>
                    <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                        <ListboxOptions class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                            <ListboxOption as="template" v-for="category in categories" :key="category.id" :value="category.name" v-slot="{ active, selected }">
                                <li :class="[active ? 'text-neutral-900 bg-neutral-100' : 'text-neutral-700', 'relative cursor-default select-none py-2 pl-3 pr-9']">
                                    {{ category.name }}
                                    <span v-if="selected" :class="[active ? 'text-neutral-700' : 'text-neutral-500', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </li>
                            </ListboxOption>
                        </ListboxOptions>
                    </transition>
                </div>
            </Listbox>
            <Popover as="div" class="w-1/4">
                <div class="relative">
                    <PopoverButton class="w-full block mb-1 px-2 py-1 text-neutral-700 border border-neutral-300 rounded-md shadow-sm hover:bg-neutral-50">
                        Salary (0)
                    </PopoverButton>
                    <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                        <PopoverPanel class="absolute z-10 mt-1 max-h-56 w-full py-1 overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                            <div class="p-3">
                                <div>
                                    <Label name="Min salary" />
                                    <Input
                                        v-model="salary.min"
                                        type="number"
                                        min="0"
                                        :max="salary.max"
                                        step="1000"
                                    />
                                </div>
                                <div>
                                    <Label name="Max salary" />
                                    <Input
                                        v-model="salary.max"
                                        type="number"
                                        :min="salary.min"
                                        max="100000"
                                        step="1000"
                                    />
                                </div>
                            </div>
                        </PopoverPanel>
                    </transition>
                </div>
            </Popover>
            <!--            <Listbox as="div" class="w-1/4" v-model="selected.category" multiple>-->
<!--                <div class="relative">-->
<!--                    <ListboxButton class="w-full block mb-1 p-2 text-neutral-700 border border-neutral-300 rounded-md shadow-sm hover:bg-neutral-50">-->
<!--                        Salary ({{ selected.category.length }})-->
<!--                    </ListboxButton>-->
<!--                    <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">-->
<!--                        <ListboxOptions class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">-->
<!--                            <ListboxOption as="template" v-for="category in categories" :key="category.id" :value="category" v-slot="{ active, selected }">-->
<!--                                <li :class="[active ? 'text-neutral-900 bg-neutral-100' : 'text-neutral-700', 'relative cursor-default select-none py-2 pl-3 pr-9']">-->
<!--                                    {{ category.name }}-->
<!--                                    <span v-if="selected" :class="[active ? 'text-neutral-700' : 'text-neutral-500', 'absolute inset-y-0 right-0 flex items-center pr-4']">-->
<!--                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">-->
<!--                                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />-->
<!--                                        </svg>-->
<!--                                    </span>-->
<!--                                </li>-->
<!--                            </ListboxOption>-->
<!--                        </ListboxOptions>-->
<!--                    </transition>-->
<!--                </div>-->
<!--            </Listbox>-->
            <Listbox as="div" class="w-1/4" v-model="selected.level" multiple>
                <div class="relative">
                    <ListboxButton class="w-full block mb-1 px-2 py-1 text-neutral-700 border border-neutral-300 rounded-md shadow-sm hover:bg-neutral-50">
                        Level ({{ selected.level.length }})
                    </ListboxButton>
                    <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                        <ListboxOptions class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                            <ListboxOption as="template" v-for="level in levels" :key="level.id" :value="level.value" v-slot="{ active, selected }">
                                <li :class="[active ? 'text-neutral-900 bg-neutral-100' : 'text-neutral-700', 'capitalize relative cursor-default select-none py-2 pl-3 pr-9']">
                                    {{ level.name }}
                                    <span v-if="selected" :class="[active ? 'text-neutral-700' : 'text-neutral-500', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </li>
                            </ListboxOption>
                        </ListboxOptions>
                    </transition>
                </div>
            </Listbox>
            <Listbox as="div" class="w-1/4" v-model="selected.contract" multiple>
                <div class="relative">
                    <ListboxButton class="w-full block mb-1 px-2 py-1 text-neutral-700 border border-neutral-300 rounded-md shadow-sm hover:bg-neutral-50">
                        Contract ({{ selected.contract.length }})
                    </ListboxButton>
                    <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                        <ListboxOptions class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                            <ListboxOption as="template" v-for="contract in contracts" :key="contract.id" :value="contract" v-slot="{ active, selected }">
                                <li :class="[active ? 'text-neutral-900 bg-neutral-100' : 'text-neutral-700', 'capitalize relative cursor-default select-none py-2 pl-3 pr-9']">
                                    {{ contract }}
                                    <span v-if="selected" :class="[active ? 'text-neutral-700' : 'text-neutral-500', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                            <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                        </svg>
                                    </span>
                                </li>
                            </ListboxOption>
                        </ListboxOptions>
                    </transition>
                </div>
            </Listbox>
        </div>
    </div>
</template>
