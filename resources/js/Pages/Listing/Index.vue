<template>
    <Filter :filters="filters" />
    <div class="grid xl:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-4">
        <Listing v-for="listing in listings.data" :key="listing.id" :listing="listing" />
    </div>

    <div v-if="listings.data.length" class="w-full flex justify-center my-4">
        <Pagination :links="listings.links" />
    </div>
</template>

<script setup>

import Pagination from '@/Components/UI/Pagination.vue'
import Listing from '@/Pages/Listing/Index/Componentes/Listing.vue'
import Filter from '@/Pages/Listing/Index/Componentes/Filter.vue'

defineProps({
    listings : Object,
    filters: Object,
})
</script>
