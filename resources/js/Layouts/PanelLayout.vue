<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <nav class="py-4 bg-neutral-900 text-neutral-200">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="inline-flex items-center gap-8">
                <div>
                    <Link :href="route('panel.dashboard')">jbsats</Link>
                </div>

                <div class="inline-flex items-center gap-4">
                    <Link :href="route('panel.dashboard')">Dashboard</Link>
                    <Link :href="route('panel.posting.index')">Jobs</Link>
                    <Link :href="route('panel.apply.index')">Applications</Link>
                    <Link :href="route('panel.company.show')">Company</Link>
                </div>
            </div>
            <Menu as="div" class="relative">
                <MenuButton>
                    {{ $page.props.auth.user.name }}
                </MenuButton>
                <MenuItems class="absolute z-10 right-0 mt-1 w-32 origin-top-right bg-neutral-600 border border-neutral-700 shadow-md">
                    <MenuItem v-slot="{ active }">
                        <Link :href="route('logout')" method="post" as="button" class="w-full flex px-2 py-0.5 hover:bg-neutral-800">Logout</Link>
                    </MenuItem>
                </MenuItems>
            </Menu>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto my-8">
        <slot />
    </main>
</template>

<style>
body {
    @apply bg-neutral-100;
}
</style>
