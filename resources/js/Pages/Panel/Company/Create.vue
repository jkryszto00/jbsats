<script setup>
import { useForm } from "@inertiajs/inertia-vue3";

import PanelLayout from "@/Layouts/PanelLayout.vue";
import Card from "@/Components/Card.vue";
import Button from "@/Components/Button.vue";
import Textarea from "@/Components/Form/Textarea.vue";
import Input from "@/Components/Form/Input.vue";
import Label from "@/Components/Form/Label.vue";
import InputError from "@/Components/Form/InputError.vue";

const form = useForm({
    image: null,
    name: '',
    description: '',
    founded: '',
    size: '',
    industry: '',
    city: '',
    country: ''
})

function submit() {
    form.post(route('panel.company.store'))
}
</script>

<template>
  <PanelLayout>
      <Card class="mx-auto max-w-2xl" title="Create company">
          <form @submit.prevent="submit" id="company-form">
              <div class="mb-4">
                  <Label name="Logo" />
                  <input type="file" class="w-full block mb-1 px-2 py-1 text-neutral-700 border border-neutral-300 rounded-md shadow-sm" :class="[error ? 'border-red-400' : 'border-neutral-300']" @change="form.image = $event.target.files[0]">
                  <InputError :message="form.errors.image" />
              </div>
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
                  <Button type="submit" form="company-form">Create</Button>
              </div>
          </template>
      </Card>
  </PanelLayout>
</template>
