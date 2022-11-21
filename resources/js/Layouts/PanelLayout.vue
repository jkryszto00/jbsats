<script setup>
import { Link } from '@inertiajs/inertia-vue3';
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
</script>
<template>
    <nav class="bg-neutral-800">
        <div class="mx-auto px-4">
            <div class="flex h-16 items-center justify-between">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <Link :href="route('site.index')" class="font-bold text-neutral-300">jbsats</Link>
                    </div>
                    <div class="ml-10 flex items-baseline space-x-4">
                        <Link :href="route('panel.dashboard')" class="px-3 py-2 rounded-md text-sm font-semibold" :class="[$page.url === '/panel' ? 'bg-neutral-900 text-white' : 'text-neutral-300 hover:bg-neutral-700 hover:text-white']">Dashboard</Link>
                        <Link :href="route('panel.posting.index')" class="px-3 py-2 rounded-md text-sm font-semibold" :class="[$page.url.startsWith('/panel/posting') ? 'bg-neutral-900 text-white' : 'text-neutral-300 hover:bg-neutral-700 hover:text-white']">Jobs</Link>
                        <Link :href="route('panel.apply.index')" class="px-3 py-2 rounded-md text-sm font-semibold" :class="[$page.url.startsWith('/panel/candidates') ? 'bg-neutral-900 text-white' : 'text-neutral-300 hover:bg-neutral-700 hover:text-white']">Applications</Link>
                        <Link :href="route('panel.company.show')" class="px-3 py-2 rounded-md text-sm font-semibold" :class="[$page.url.startsWith('/panel/company') ? 'bg-neutral-900 text-white' : 'text-neutral-300 hover:bg-neutral-700 hover:text-white']">Company</Link>
                    </div>
                </div>
                <div class="ml-4 flex items-baseline space-x-4">
                    <Menu as="div" class="relative">
                        <MenuButton>
                            <span class="text-neutral-300">{{ $page.props.auth.user.name }}</span>
                        </MenuButton>
                        <transition enter-active-class="transition ease-out duration-100" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
                            <MenuItems class="absolute right-0 z-10 mt-2 w-36 origin-top-right rounded-md bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none">
                                <MenuItem v-slot="{ active }">
                                    <Link :href="route('site.index')" :class="[active ? 'bg-neutral-100' : '', 'block px-4 py-2 text-sm text-neutral-700']">Go to site</Link>
                                </MenuItem>
                                <MenuItem v-slot="{ active }">
                                    <Link :href="route('logout')" method="post" as="button" :class="[active ? 'bg-neutral-100' : '', 'w-full text-left px-4 py-2 text-sm text-neutral-700']">Logout</Link>
                                </MenuItem>
                            </MenuItems>
                        </transition>
                    </Menu>
                </div>
            </div>
        </div>
    </nav>
    <main class="mx-auto max-w-7xl py-8">
        <slot />
    </main>
</template>
<style>
body {
    @apply bg-neutral-100;
}
</style>
