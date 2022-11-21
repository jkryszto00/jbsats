<script setup>
import { computed } from "vue";
import { upperCase } from "lodash/string";
import { isNull } from "lodash/lang";

import PanelLayout from "@/Layouts/PanelLayout.vue";
import Card from "@/Components/Card.vue";
import Button from "@/Components/Button.vue";

const props = defineProps(['jobOffer'])

const formatter = new Intl.NumberFormat('en-US')

const salaries = computed(() => {
    return props.jobOffer.salary.map((salary) => {
        return {
            type: salary.type,
            rate: ((salary.exact && !isNull(salary.exact)) ? formatter.format(salary.exact) : `${formatter.format(salary.from)} - ${formatter.format(salary.to)}`) + ` ${upperCase(props.jobOffer.contract.currency)}`,
            per: salary.per
        }
    })
})
</script>
<template>
    <PanelLayout>
        <div class="flex items-start gap-4 justify-between">
            <Card class="w-2/3">
                <div class="divide-y divide-neutral-200">
                    <div class="flex items-center gap-2 pb-2">
                        <img :src="jobOffer.company.logo" :alt="jobOffer.company.name" class="rounded border object-cover h-12 w-12" />
                        <div>
                            <div class="text-2xl font-bold">{{ jobOffer.title }}</div>
                            <div>{{ jobOffer.company.name }}</div>
                        </div>
                    </div>
                    <div class="flex justify-between gap-4 py-4">
                        <div class="flex-1">
                            <span class="text-neutral-500">Category: </span>
                            <span class="text-neutral-700 font-semibold">{{ jobOffer.categories.map((category) => category.name).join(", ") }}</span>
                        </div>
                        <div class="flex-1 flex items-center gap-2">
                            <span class="text-neutral-500">Level: </span>
                            <span class="capitalize text-neutral-700 font-semibold">{{ jobOffer.level.name }}</span>
                            <div class="flex items-center gap-1 text-neutral-700">
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
            </Card>
            <Card class="w-1/3">
                <div class="divide-y divide-neutral-200">
                    <template v-for="salary in salaries">
                        <div class="py-2 first:pt-0">
                            <span class="uppercase text-sm text-neutral-500">{{ salary.type }}</span>
                            <div class="flex items-center gap-2">
                                <span class="font-semibold text-xl text-neutral-700">{{ salary.rate }}</span>
                                <span class="text-sm text-neutral-500">/ {{ salary.per }}</span>
                            </div>
                        </div>
                    </template>
                </div>
                <div class="py-2">
                    <Button type="button" class="w-full">Apply</Button>
                </div>
                <div class="py-2">
                    <div class="inline-flex gap-2 text-neutral-700">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                            <path d="M12.75 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM7.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM8.25 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM9.75 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM10.5 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM12.75 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM14.25 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 17.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 15.75a.75.75 0 100-1.5.75.75 0 000 1.5zM15 12.75a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM16.5 13.5a.75.75 0 100-1.5.75.75 0 000 1.5z" />
                            <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 017.5 3v1.5h9V3A.75.75 0 0118 3v1.5h.75a3 3 0 013 3v11.25a3 3 0 01-3 3H5.25a3 3 0 01-3-3V7.5a3 3 0 013-3H6V3a.75.75 0 01.75-.75zm13.5 9a1.5 1.5 0 00-1.5-1.5H5.25a1.5 1.5 0 00-1.5 1.5v7.5a1.5 1.5 0 001.5 1.5h13.5a1.5 1.5 0 001.5-1.5v-7.5z" clip-rule="evenodd" />
                        </svg>
                        <span>Closing on {{ jobOffer.expired_at }}</span>
                    </div>
                </div>
            </Card>
        </div>
    </PanelLayout>
</template>
