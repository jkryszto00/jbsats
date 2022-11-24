<script setup>
import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { Listbox, ListboxButton, ListboxOption, ListboxOptions } from '@headlessui/vue'

import PanelLayout from "@/Layouts/PanelLayout.vue";
import Card from "@/Components/Card.vue";
import Button from "@/Components/Button.vue";
import Textarea from "@/Components/Form/Textarea.vue";
import Input from "@/Components/Form/Input.vue";
import Label from "@/Components/Form/Label.vue";
import InputError from "@/Components/Form/InputError.vue";

defineProps(['model'])

const newSalary = ref({
    type: '',
    from: '',
    to: '',
    per: ''
})

function addNewSalary() {
    form.salary.push({
        type: newSalary.value.type,
        from: newSalary.value.from,
        to: newSalary.value.to,
        per: newSalary.value.per
    })

    newSalary.value.type = ''
    newSalary.value.from = ''
    newSalary.value.to = ''
    newSalary.value.exact = ''
    newSalary.value.per = ''
}

function removeSalary(index) {
    form.salary.splice(index, 1)
}

const form = useForm({
    title: '',
    description: '',
    category: [],
    level: '',
    contract: {
        currency: '',
        time: ''
    },
    salary: []
})

const submit = () => {
    form.post(route('panel.posting.store'))
}
</script>
<template>
    <PanelLayout>
        <Card class="mx-auto max-w-2xl" title="Post job offer">
            <form @submit.prevent="submit" id="job-form">
                <div class="mb-4">
                    <Label name="Title" />
                    <Input type="text" v-model="form.title" :error="form.errors.title" />
                    <InputError :message="form.errors.title" />
                </div>
                <div class="mb-4">
                    <Label name="Description" />
                    <Textarea rows="5" v-model="form.description" :error="form.errors.description" />
                    <InputError :message="form.errors.description" />
                </div>
                <div class="mb-4 flex gap-4 justify-between">
                    <div class="flex-1">
                        <Label name="Categories" />
                        <Listbox as="div" v-model="form.category" multiple>
                            <div class="relative mt-1">
                                <ListboxButton class="w-full block mb-1 px-2 py-1 text-neutral-700 border rounded-md shadow-sm" :class="[form.errors.category ? 'border-red-400' : 'border-neutral-300']">
                                    <span v-if="form.category.length === 0">Select categories</span>
                                    <template v-if="2 >= form.category.length" v-for="c in form.category">
                                        <span class="bg-neutral-100 text-neutral-500 px-2 py-0.5 rounded mr-2">
                                            {{ c.name }}
                                        </span>
                                    </template>
                                    <span v-if="form.category.length > 2" class="bg-neutral-100 text-neutral-500 px-2 py-0.5 rounded mr-2">{{ form.category[0].name }}</span>
                                    <span v-if="form.category.length > 2" class="bg-neutral-100 text-neutral-500 px-2 py-0.5 rounded">More ({{ form.category.length - 1 }})</span>
                                </ListboxButton>
                                <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                                    <ListboxOptions class="absolute z-10 mt-1 max-h-56 w-full overflow-auto rounded-md bg-white py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm">
                                        <ListboxOption as="template" v-for="category in model.categories" :key="category.id" :value="category" v-slot="{ active, selected }">
                                            <li :class="[active ? 'text-neutral-900 bg-neutral-100' : 'text-neutral-700', 'relative cursor-default select-none py-2 pl-3 pr-9']">
                                                {{ category.name }}
                                                <span v-if="selected" :class="[active ? 'text-neutral-700' : 'text-neutral-500', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                    <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                            </li>
                                        </ListboxOption>
                                    </ListboxOptions>
                                </transition>
                            </div>
                        </Listbox>
                        <InputError :message="form.errors.category" />
                    </div>
                    <div class="flex-1">
                        <Label name="Level" />
                        <select v-model="form.level" class="w-full capitalize block mb-1 px-2 py-1 text-neutral-700 border rounded-md shadow-sm" :class="[form.errors.level ? 'border-red-400' : 'border-neutral-300']">
                            <template v-for="level in model.levels">
                                <option :value="level.value">{{ level.name }}</option>
                            </template>
                        </select>
                        <InputError :message="form.errors.level" />
                    </div>
                </div>
                <div class="mb-4 flex gap-4 justify-between">
                    <div class="flex-1">
                        <Label name="Long" />
                        <select v-model="form.contract.time" class="w-full block capitalize mb-1 px-2 py-1 text-neutral-700 border rounded-md shadow-sm" :class="[form.errors['contract.time'] ? 'border-red-400' : 'border-neutral-300']">
                            <template v-for="time in model.times">
                                <option :value="time">{{ time }}</option>
                            </template>
                        </select>
                        <InputError :message="form.errors['contract.time']" />
                    </div>
                    <div class="flex-1">
                        <Label name="Currency" />
                        <select v-model="form.contract.currency" class="w-full block uppercase mb-1 px-2 py-1 text-neutral-700 border rounded-md shadow-sm" :class="[form.errors['contract.currency'] ? 'border-red-400' : 'border-neutral-300']">
                            <template v-for="currency in model.currencies">
                                <option :value="currency">{{ currency }}</option>
                            </template>
                        </select>
                        <InputError :message="form.errors['contract.currency']" />
                    </div>
                </div>
                <div class="mb-4">
                    <Label name="Salaries" />
                    <InputError :message="form.errors.salary" />
                    <div class="divide-y divide-neutral-200">
                        <template v-for="(salary, index) in form.salary">
                            <div class="py-2 flex items-center justify-between">
                                <div>
                                    <span class="capitalize font-semibold text-neutral-500">{{ salary.type }}:</span>
                                    <div class="text-neutral-700">{{ salary.from }} - {{  salary.to }} / {{ salary.per }}</div>
                                </div>
                                <Button type="button" @click="removeSalary(index)" class="px-2 bg-neutral-50 text-neutral-700 border border-neutral-300 rounded-md shadow-sm hover:bg-neutral-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-4 h-4">
                                        <path d="M6.28 5.22a.75.75 0 00-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 101.06 1.06L10 11.06l3.72 3.72a.75.75 0 101.06-1.06L11.06 10l3.72-3.72a.75.75 0 00-1.06-1.06L10 8.94 6.28 5.22z" />
                                    </svg>
                                </Button>
                            </div>
                        </template>
                    </div>
                </div>
                <div class="flex gap-2">
                    <select v-model="newSalary.type" class="w-3/12 block capitalize px-2 py-1 text-neutral-700 border border-neutral-300 rounded-md shadow-sm">
                        <template v-for="type in model.types">
                            <option :value="type">{{ type }}</option>
                        </template>
                    </select>
                    <div class="w-8/12 flex items-center gap-1">
                        <Input type="number" v-model="newSalary.from" min="0" placeholder="From" class="flex-1 mb-0" />
                        <span class="text-sm text-neutral-500">-</span>
                        <Input type="number" v-model="newSalary.to" min="0" placeholder="To" class="flex-1 mb-0" />
                    </div>
                    <select v-model="newSalary.per" class="w-2/12 block capitalize px-2 py-1 text-neutral-700 border border-neutral-300 rounded-md shadow-sm">
                        <template v-for="per in model.pers">
                            <option :value="per">{{ per }}</option>
                        </template>
                    </select>
                    <Button type="button" @click="addNewSalary" class="px-2 bg-neutral-50 text-neutral-700 border border-neutral-300 rounded-md shadow-sm hover:bg-neutral-100">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                            <path d="M10.75 6.75a.75.75 0 00-1.5 0v2.5h-2.5a.75.75 0 000 1.5h2.5v2.5a.75.75 0 001.5 0v-2.5h2.5a.75.75 0 000-1.5h-2.5v-2.5z" />
                        </svg>
                    </Button>
                </div>
            </form>
            <template #footer>
                <div class="flex justify-end">
                    <Button type="submit" form="job-form">Post job</Button>
                </div>
            </template>
        </Card>
    </PanelLayout>
</template>
