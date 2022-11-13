<script setup>
import { Menu, MenuButton, MenuItems, MenuItem } from '@headlessui/vue'
import { Link, usePage } from '@inertiajs/inertia-vue3';
import { computed } from "vue";
import { isNull } from "lodash/lang";

const isLogged = computed(() => !isNull(usePage().props.value.auth.user))
</script>

<template>
    <nav class="py-4 bg-neutral-100 text-neutral-900">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="inline-flex items-center gap-8">
                <div>
                    <Link href="/">jbsats</Link>
                </div>

                <div class="inline-flex items-center gap-4">
                    <Link :href="route('site.jobs.index')">Jobs</Link>
                    <Link>Companies</Link>
                </div>
            </div>
            <Menu v-if="isLogged" as="div" class="relative">
                <MenuButton>
                    {{ $page.props.auth.user.name }}
                </MenuButton>
                <MenuItems class="absolute z-10 right-0 mt-1 w-32 origin-top-right bg-white border border-neutral-300 shadow-md">
                    <MenuItem v-slot="{ active }" class="px-2 py-0.5 hover:bg-neutral-100">
                        <Link :href="route('panel.dashboard')" class="flex">Go to panel</Link>
                    </MenuItem>
                    <MenuItem v-slot="{ active }">
                        <Link :href="route('logout')" method="post" as="button" class="w-full flex px-2 py-0.5 hover:bg-neutral-100">Logout</Link>
                    </MenuItem>
                </MenuItems>
            </Menu>
            <div v-else class="inline-flex items-center gap-4">
                <Link :href="route('login')">Login</Link>
                <Link :href="route('register')">Register</Link>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto mt-8">
        <slot />
    </main>
</template>
