<script setup>
import { useForm } from "@inertiajs/inertia-vue3";

import PanelLayout from "@/Layouts/PanelLayout.vue";
import Card from "@/Components/Card.vue";
import Button from "@/Components/Button.vue";
import Textarea from "@/Components/Form/Textarea.vue";
import Input from "@/Components/Form/Input.vue";
import Label from "@/Components/Form/Label.vue";
import InputError from "@/Components/Form/InputError.vue";

const prop = defineProps(['company'])

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
        <Card class="mx-auto max-w-2xl" title="Edit company">
            <form @submit.prevent="submit" id="company-form">
                <div class="mb-4">
                    <Label name="Name" />
                    <Input type="text" v-model="form.name" :error="form.errors.name" />
                    <InputError :message="form.errors.name" />
                </div>
                <div class="mb-4">
                    <Label name="Description" />
                    <Textarea rows="5" v-model="form.description" :error="form.errors.description" />
                    <InputError :message="form.errors.description" />
                </div>
                <div class="mb-4 flex gap-4">
                    <div class="flex-1">
                        <Label name="Founded" />
                        <Input type="text" v-model="form.founded" :error="form.errors.founded" />
                        <InputError :message="form.errors.founded" />
                    </div>
                    <div class="flex-1">
                        <Label name="Size" />
                        <Input type="text" v-model="form.size" :error="form.errors.size" />
                        <InputError :message="form.errors.size" />
                    </div>
                    <div class="flex-1">
                        <Label name="Industry" />
                        <Input type="text" v-model="form.industry" :error="form.errors.industry" />
                        <InputError :message="form.errors.industry" />
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <Label name="City" />
                        <Input type="text" v-model="form.city" :error="form.errors.city" />
                        <InputError :message="form.errors.city" />
                    </div>
                    <div class="flex-1">
                        <Label name="Country" />
                        <Input type="text" v-model="form.country" :error="form.errors.country" />
                        <InputError :message="form.errors.country" />
                    </div>
                </div>
            </form>
            <template #footer>
                <div class="flex justify-end">
                    <Button type="submit" form="company-form">Update</Button>
                </div>
            </template>
        </Card>
    </PanelLayout>
</template>
