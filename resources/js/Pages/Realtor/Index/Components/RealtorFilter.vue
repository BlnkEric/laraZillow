<template>
    <form action="">
        <div class="my-5 flex flex-wrap gap-5">
            <div class="flex flex-nowrap items-center gap-2">
                <input id="deleted" v-model="filterForm.deleted" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                <label for="deleted">Deleted</label>
            </div>
            <div>
                <select id="" v-model="filterForm.by" name="" class="filter-input-l w-24">
                    <option value="created_at">Added</option>
                    <option value="price">Price</option>
                </select>
                <select id="" v-model="filterForm.order" name="" class="filter-input-r w-32">
                    <option v-for="option in sortOptions" :key="option.value" :value="option.value">
                        {{ option.label }}
                    </option>
                </select>
            </div>
        </div>
    </form>
</template>

<script setup>
import {reactive, watch, computed} from 'vue'
import {Inertia} from '@inertiajs/inertia'
import {debounce} from 'lodash'

const props = defineProps({
    filters: Object,
})

const sortLabels = {
    created_at: [
        {
            label: 'Latest',
            value: 'desc',
        },
        {
            label: 'Oldest',
            value: 'asc',
        },
    ],
    price: [
        {
            label: 'Cheapest',
            value: 'asc',
        }, 
        {
            label: 'Pricey',
            value: 'desc',
        },
    ],
}

const sortOptions = computed(() => sortLabels[filterForm.by])

const filterForm = reactive({
    deleted: props.filters.deleted ?? false, 
    by: props.filters.by ?? 'created_at',
    order: props.filters.order ?? 'desc',
})

//for one singel property or watching one item changes
watch(filterForm, debounce(() => 
    // console.log(newValue, OldValue),
    Inertia.get(
        route('realtor.listings.index'),
        filterForm,
        {
            preserveState: true,
            preserveScroll: true,
        },
    ), 1000),
)
//if we got more than one thing we have to use an array
// watch([() => filterForm.deleted, () => reactiveOrRefOrComputed.somethingElse], (newValue, OldValue) => 
//     console.log(newValue, OldValue),
// )
</script>