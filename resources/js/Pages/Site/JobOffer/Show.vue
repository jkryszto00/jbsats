<script setup>
import SiteLayout from "@/Layouts/SiteLayout.vue";
import {Link, useForm} from '@inertiajs/inertia-vue3';
import {computed} from "vue";
import {isNull} from "lodash/lang";
import {upperCase} from "lodash/string";
import { ref } from 'vue'
import {
    Dialog,
    DialogPanel,
    DialogTitle,
    DialogDescription,
} from '@headlessui/vue'

const props = defineProps(['jobOffer'])

const salaries = computed(() => {
    return props.jobOffer.salary.map((salary) => {
        return {
            type: salary.type,
            rate: ((salary.exact && !isNull(salary.exact)) ? salary.exact : `${salary.from} - ${salary.to}`) + ` ${upperCase(props.jobOffer.contract.currency)}`,
            per: salary.per
        }
    })
})

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

const submit = () => form.post(route('site.jobs.apply', { jobOffer: props.jobOffer }))
</script>
<template>
    <SiteLayout>
        <div class="flex items-start gap-4 justify-between">
            <div class="w-2/3 p-4 bg-neutral-100">
                <div class="border-b border-neutral-200 pb-4">
                    <div class="text-2xl font-bold">{{ jobOffer.title }}</div>
                    <Link :href="route('site.companies.show', { company: jobOffer.company })">{{ jobOffer.company.name }}</Link>
                </div>
                <div class="flex justify-between gap-4 py-2 border-b border-neutral-200 pb-2">
                    <div class="flex-1">
                        <span>Category: </span>
                        <template v-for="category in jobOffer.categories">
                            <span class="font-bold mr-2">{{ category.name }}</span>
                        </template>
                    </div>
                    <div class="flex-1 flex items-center gap-2">
                        <span class="capitalize">{{ jobOffer.level.name }}</span>
                        <div class="flex items-center gap-1">
                            <template v-for="n in jobOffer.level.value">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path fill-rule="evenodd" d="M10.788 3.21c.448-1.077 1.976-1.077 2.424 0l2.082 5.007 5.404.433c1.164.093 1.636 1.545.749 2.305l-4.117 3.527 1.257 5.273c.271 1.136-.964 2.033-1.96 1.425L12 18.354 7.373 21.18c-.996.608-2.231-.29-1.96-1.425l1.257-5.273-4.117-3.527c-.887-.76-.415-2.212.749-2.305l5.404-.433 2.082-5.006z" clip-rule="evenodd" />
                                </svg>
                            </template>
                        </div>
                    </div>
                </div>
                <div v-html="jobOffer.description" class="py-2"></div>
            </div>
            <div class="w-1/3 p-4 bg-neutral-100 flex flex-col gap-y-4">
                <div class="divide-y divide-neutral-300">
                    <template v-for="salary in salaries">
                        <div class="py-2">
                            <span class="uppercase">{{ salary.type }}</span>
                            <div class="flex items-center gap-2">
                                <span class="font-bold text-xl">{{ salary.rate }}</span>
                                <span>/ {{ salary.per }}</span>
                            </div>
                        </div>
                    </template>
                </div>
                <button type="button" class="bg-neutral-900 text-neutral-50 py-6 text-lg" @click="setIsOpen(true)">Apply</button>
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
                                    <DialogDescription class="mb-8 p-2 border border-neutral-300">
                                        {{ jobOffer.title }}
                                        {{ jobOffer.salary[0] }}
                                    </DialogDescription>
                                    <form @submit.prevent="submit" class="flex flex-col gap-y-4">
                                        <input type="text" v-model="form.name" placeholder="name and surname">
                                        <input type="text" v-model="form.email" placeholder="email">
                                        <textarea cols="30" rows="5" v-model="form.about" placeholder="about you and links"></textarea>
                                        <input type="file" @change="form.cv = $event.target.files[0]">
                                        <button type="submit" class="py-4 text-white bg-blue-600 hover:bg-blue-700">Apply</button>
                                    </form>
                                </div>
                            </div>
                        </DialogPanel>
                    </div>
                </Dialog>
                <div class="py-2">
                    <div class="inline-flex gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                            <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z" clip-rule="evenodd" />
                        </svg>
                        <span>{{ jobOffer.expired_at }}</span>
                    </div>
                </div>
            </div>
        </div>
    </SiteLayout>
</template>
