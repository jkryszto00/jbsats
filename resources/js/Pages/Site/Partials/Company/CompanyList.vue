<script setup>
import Card from '@/Components/Card.vue'
import CompanyListItem from "@/Pages/Site/Partials/Company/CompanyListItem.vue";

defineProps(['title', 'companies'])
</script>
<template>
    <Card>
        <template #header>
            <div class="text-neutral-900 font-semibold text-xl">{{ title }}</div>
        </template>

        <div class="flex gap-4">
            <template v-for="company in companies">
                <CompanyListItem :company="company" />
            </template>
        </div>
    </Card>
</template>
