<template>
    <form @submit.prevent="filter">
        <div class="flex flex-wrap gap-3 my-4">
            <div class="flex flex-nowrap items-center">
                <input v-model.number="filterForm.priceFrom" class="filter-input-l w-28" type="text" placeholder="Price from" />
                <input v-model.number="filterForm.priceTo" class="filter-input-r w-28" type="text" placeholder="Price to" />
            </div>
            <div class="flex flex-nowrap items-center">
                <select v-model="filterForm.beds" class="filter-input-l w-28" name="">
                    <option :value="null">beds</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option :value="6">6+</option>
                </select>
                <select v-model="filterForm.baths" class="filter-input-r w-28" name="">
                    <option :value="null">baths</option>
                    <option v-for="n in 5" :key="n" :value="n">{{ n }}</option>
                    <option :value="6">6+</option>
                </select>
            </div>
            <div class="flex flex-nowrap items-center">
                <input v-model.number="filterForm.areaFrom" class="filter-input-l w-28" type="text" placeholder="Area from" />
                <input v-model.number="filterForm.areaTo" class="filter-input-r w-28" type="text" placeholder="Area to" />
            </div>

            <button type="submit" class="btn-normal">Filter</button>
            <button type="reset" class="text-red-500" @click="clear">Clear</button>
        </div>
    </form>
</template>

<script setup>
import { useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
    filters: Object,
})

const filterForm = useForm({
    priceFrom : props.filters.priceFrom ?? null,
    priceTo : props.filters.priceTo ?? null,
    baths : props.filters.baths ?? null,
    beds : props.filters.beds ?? null,
    areaFrom : props.filters.areaFrom ?? null,
    areaTo : props.filters.areaTo ?? null,
})

const filter = () => filterForm.get(route('listings.index'),
    {
        preserveState: true,
        preserveScroll: true,
    },
)

const clear = () => {
    filterForm.priceFrom = null
    filterForm.priceTo = null
    filterForm.baths = null
    filterForm.beds = null
    filterForm.areaFrom = null
    filterForm.areaTo = null
    filter()
}


</script>