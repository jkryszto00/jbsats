<script setup>
import PanelLayout from "@/Layouts/PanelLayout.vue";
import {useForm} from "@inertiajs/inertia-vue3";

const form = useForm({
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
      create company
      <form @submit.prevent="submit">
          <input type="text" v-model="form.name" placeholder="name">
          <input type="text" v-model="form.description" placeholder="description">
          <input type="text" v-model="form.founded" placeholder="founded">
          <input type="text" v-model="form.size" placeholder="size">
          <input type="text" v-model="form.industry" placeholder="industry">
          <input type="text" v-model="form.city" placeholder="city">
          <input type="text" v-model="form.country" placeholder="country">
          <button type="submit">create</button>
      </form>
  </PanelLayout>
</template>
