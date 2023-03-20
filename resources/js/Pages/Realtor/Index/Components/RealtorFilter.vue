<template>
    <form action="">
        <div class="my-5 flex flex-wrap gap-2">
            <div class="flex flex-nowrap items-center gap-2">
                <input id="deleted" v-model="filterForm.deleted" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500" />
                <label for="deleted">Deleted</label>
            </div>
        </div>
    </form>
</template>

<script setup>
import {reactive, watch} from 'vue'
import {Inertia} from '@inertiajs/inertia'
import {debounce} from 'lodash'
const filterForm = reactive({
    deleted: false,
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