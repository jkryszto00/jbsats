<script setup>
import PanelLayout from "@/Layouts/PanelLayout.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import {ref} from "vue";

defineProps(['levels', 'currencies', 'types', 'times', 'pers'])

const form = useForm({
    title: '',
    description: '',
    level: '',
    contract: {
        currency: '',
        time: ''
    },
    salary: []
})

const newSalary = ref({
    type: '',
    from: '',
    to: '',
    exact: '',
    per: ''
})

const submit = () => {
    form.post(route('panel.posting.store'))
}

function addNewSalary() {
    form.salary.push({
        type: newSalary.value.type,
        from: newSalary.value.from,
        to: newSalary.value.to,
        exact: newSalary.value.exact,
        per: newSalary.value.per
    })

    newSalary.value.type = ''
    newSalary.value.from = ''
    newSalary.value.to = ''
    newSalary.value.exact = ''
    newSalary.value.per = ''
}
</script>

<template>
    <PanelLayout>
        create job offer
        {{ form.data() }}
        <form @submit.prevent="submit">
            <input type="text" v-model="form.title" placeholder="title">
            <input type="text" v-model="form.description" placeholder="description">
            <select v-model="form.level" class="capitalize">
                <template v-for="level in levels">
                    <option :value="level.value">{{ level.name }}</option>
                </template>
            </select>
            <select v-model="form.contract.currency" class="uppercase">
                <template v-for="currency in currencies">
                    <option :value="currency">{{ currency }}</option>
                </template>
            </select>
            <select v-model="form.contract.time" class="capitalize">
                <template v-for="time in times">
                    <option :value="time">{{ time }}</option>
                </template>
            </select>
            <ul>
                <template v-for="salary in form.salary">
                    <li>
                        {{salary.type }} | {{ salary.from }} - {{ salary.to }} {{ salary.exact }} / {{ salary.per }}
                    </li>
                </template>
            </ul>
            <div>
                {{ newSalary }}
                <select v-model="newSalary.type" class="capitalize">
                    <template v-for="type in types">
                        <option :value="type">{{ type }}</option>
                    </template>
                </select>
                <input type="number" v-model="newSalary.from" placeholder="from">
                -
                <input type="number" v-model="newSalary.to" placeholder="to">
                or
                <input type="number" v-model="newSalary.exact" placeholder="exact">
                per
                <select v-model="newSalary.per">
                    <template v-for="per in pers">
                        <option :value="per">{{ per }}</option>
                    </template>
                </select>
                <button type="button" @click="addNewSalary">add</button>
            </div>
            <button type="submit">create</button>
        </form>
    </PanelLayout>
</template>
