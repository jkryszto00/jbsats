<script setup>
import PanelLayout from "@/Layouts/PanelLayout.vue";
import {useForm} from "@inertiajs/inertia-vue3";

const prop = defineProps({
    company: {
        type: Object,
        required: true
    }
})

const form = useForm({
    name: prop.company.name,
    description: prop.company.description,
    founded: prop.company.founded,
    size: prop.company.size,
    industry: prop.company.industry,
    city: prop.company.city,
    country: prop.company.country
})

function submit() {
    form.patch(route('panel.company.update'))
}
</script>

<template>
    <PanelLayout>
        edit company {{ company.name }}
        <form @submit.prevent="submit">
            <input type="text" v-model="form.name" placeholder="name">
            <input type="text" v-model="form.description" placeholder="description">
            <input type="text" v-model="form.founded" placeholder="founded">
            <input type="text" v-model="form.size" placeholder="size">
            <input type="text" v-model="form.industry" placeholder="industry">
            <input type="text" v-model="form.city" placeholder="city">
            <input type="text" v-model="form.country" placeholder="country">
            <button type="submit">update</button>
        </form>
    </PanelLayout>
</template>
