<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { Dialog, DialogPanel, DialogTitle, DialogDescription } from '@headlessui/vue'
import Button from "@/Components/Button.vue";
import Input from "@/Components/Form/Input.vue";
import Textarea from "@/Components/Form/Textarea.vue";
import InputError from "@/Components/Form/InputError.vue";

const prop = defineProps(['job_offer'])

const isOpen = ref(false)

function setIsOpen(value) {
    isOpen.value = value
}

const form = useForm({
    name: '',
    email: '',
    about: '',
    cv: ''
})

const submit = () => form.post(route('site.jobs.apply', { jobOffer: prop.job_offer }))
</script>
<template>
    <div class="py-2">
        <Button type="button" @click="setIsOpen(true)" class="w-full">Apply</Button>
        <Dialog :open="isOpen" @close="setIsOpen" class="relative z-50">
            <div class="fixed inset-0 flex items-center justify-center">
                <DialogPanel class="w-full min-h-screen bg-white">
                    <div class="p-4 flex justify-end">
                        <button type="button" @click="setIsOpen(false)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex justify-center">
                        <div class="w-1/3 flex flex-col">
                            <DialogTitle class="mb-4 text-center text-2xl font-bold">Apply for the job</DialogTitle>
                            <DialogDescription class="mb-8 p-2 bg-neutral-50 border border-neutral-300 rounded-lg">
                                <div class="flex items-center gap-2">
                                    <img :src="job_offer.company.logo" :alt="job_offer.company.name" class="h-10 w-10 border border-neutral-200 rounded object-cover">
                                    <div>
                                        <div class="font-medium text-neutral-700 transition-all hover:text-neutral-900">{{ job_offer.title }}</div>
                                        <div class="block text-sm text-neutral-500">{{ job_offer.company.name }}</div>
                                    </div>
                                </div>
                            </DialogDescription>
                            <form @submit.prevent="submit" class="flex flex-col gap-y-4">
                                <div>
                                    <Input type="text" v-model="form.name" placeholder="Name and surname" :error="form.errors.name"/>
                                    <InputError :message="form.errors.name" />
                                </div>
                                <div>
                                    <Input type="email" v-model="form.email" placeholder="Email" :error="form.errors.email"/>
                                    <InputError :message="form.errors.email" />
                                </div>
                                <div>
                                    <Textarea cols="30" rows="5" v-model="form.about" placeholder="About you and links" :error="form.errors.about" />
                                    <InputError :message="form.errors.about" />
                                </div>
                                <div>
                                    <input type="file" class="w-full block mb-1 px-2 py-1 text-neutral-700 border border-neutral-300 rounded-md shadow-sm" :class="[form.errors.cv ? 'border-red-400' : 'border-neutral-300']" @change="form.cv = $event.target.files[0]">
                                    <InputError :message="form.errors.cv" />
                                </div>
                                <Button type="submit">Apply</Button>
                            </form>
                        </div>
                    </div>
                </DialogPanel>
            </div>
        </Dialog>
    </div>
</template>
