<script setup>
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
                    <Link>Applications</Link>
                    <Link :href="route('panel.company.show')">Company</Link>
                </div>
            </div>
            <div>
                {{ $page.props.auth.user.name }}
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto mt-8">
        <slot />
    </main>
</template>
