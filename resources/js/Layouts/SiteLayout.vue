<script setup>
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <nav class="py-4 bg-neutral-100 text-neutral-900">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <div class="inline-flex items-center gap-8">
                <div>
                    <Link href="/">jbsats</Link>
                </div>

                <div class="inline-flex items-center gap-4">
                    <Link>Jobs</Link>
                    <Link>Companies</Link>
                </div>
            </div>
            <div class="inline-flex items-center gap-4">
                <Link :href="route('login')">Login</Link>
                <Link :href="route('register')">Register</Link>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto mt-8">
        <slot />
    </main>
</template>
