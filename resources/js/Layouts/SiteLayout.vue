<script setup>
import { computed, useSlots } from "vue";
import { isNull } from "lodash/lang";
import { Link, usePage } from '@inertiajs/inertia-vue3';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'

import Card from '@/Components/Card.vue';
import JobOfferFilter from "@/Pages/Site/Partials/JobOfferFilter.vue";

const slots = useSlots()
const isLogged = computed(() => !isNull(usePage().props.value.auth.user))
</script>
<template>
    <div class="bg-gradient-to-b from-indigo-600 to-indigo-500">
        <nav class="mx-auto px-4">
            <div class="flex h-16 items-center justify-between border-b border-indigo-500/50">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <Link :href="route('site.index')" class="font-bold text-neutral-50">jbsats</Link>
                    </div>
                    <div class="ml-10 flex items-baseline space-x-4">
                        <Link :href="route('site.jobs.index')" class="px-3 py-2 rounded-md text-sm font-semibold" :class="[$page.url.startsWith('/jobs') ? 'bg-indigo-900 text-white' : 'text-neutral-200 hover:bg-indigo-700 hover:text-white']">Jobs</Link>
                        <Link :href="route('site.companies.index')" class="px-3 py-2 rounded-md text-sm font-semibold" :class="[$page.url.startsWith('/companies') ? 'bg-indigo-900 text-white' : 'text-neutral-200 hover:bg-indigo-700 hover:text-white']">Companies</Link>
                    </div>
                </div>
                <div class="ml-4 flex items-baseline space-x-4">
                    <template v-if="!isLogged">
                        <Link :href="route('login')" class="px-3 py-2 rounded-md text-sm font-semibold text-neutral-200 hover:bg-indigo-700 hover:text-white">Login</Link>
                        <Link :href="route('register')" class="px-3 py-2 rounded-md text-sm font-semibold text-neutral-200 hover:bg-indigo-700 hover:text-white">Register</Link>
                    </template>
                    <Menu v-else as="div" class="relative">
                        <MenuButton>
                            <span class="text-sm text-neutral-200">{{ $page.props.auth.user.name }}</span>
                        </MenuButton>
                        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                            <MenuItems class="absolute right-0 z-10 mt-2 w-36 origin-top-right rounded-md bg-white divide-y divide-neutral-100 py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <div v-if="$page.props.auth.isEmployer" class="py-1">
                                    <MenuItem v-slot="{ active }">
                                        <Link :href="route('panel.dashboard')" :class="[active ? 'bg-neutral-100' : '', 'block px-4 py-2 text-sm text-neutral-700']">Go to panel</Link>
                                    </MenuItem>
                                </div>
                                <div class="py-1">
                                    <MenuItem v-slot="{ active }">
                                        <Link :href="route('panel.dashboard')" :class="[active ? 'bg-neutral-100' : '', 'block px-4 py-2 text-sm text-neutral-700']">Profile</Link>
                                    </MenuItem>
                                    <MenuItem v-slot="{ active }">
                                        <Link :href="route('panel.dashboard')" :class="[active ? 'bg-neutral-100' : '', 'block px-4 py-2 text-sm text-neutral-700']">Settings</Link>
                                    </MenuItem>
                                </div>
                                <div class="py-1">
                                    <MenuItem v-slot="{ active }">
                                        <Link :href="route('logout')" method="post" as="button" :class="[active ? 'bg-neutral-100' : '', 'w-full text-left px-4 py-2 text-sm text-neutral-700']">Logout</Link>
                                    </MenuItem>
                                </div>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
            </div>
        </nav>
        <div v-if="slots['hero-heading']" class="h-52 pt-10">
            <h1 class="text-center font-bold text-4xl text-neutral-100"><slot name="hero-heading" /></h1>
        </div>
    </div>
    <div :class="[slots['hero-content'] ? '-mt-16' : '', 'mx-auto max-w-7xl']">
        <Card v-if="slots['hero-content']">
            <slot name="hero-content"></slot>
        </Card>

        <slot />
    </div>
</template>
<style>
body {
    @apply bg-neutral-50;
}
</style>
