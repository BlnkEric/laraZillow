<template>
    <h1 class="text-3xl mb-4">Your Listings</h1>
    <section class="mx-5">
        <RealtorFilter :filters="filters" />
    </section>
    <section class="grid grid-cols-1 lg:grid-cols-2 gap-2 mx-5">
        <Box v-for="listing in listings.data" :key="listing.id" :class="{'border-4 border-dashed': listing.deleted_at}">
            <div class="flex flex-col md:flex-row gap-2 md:items-center justify-between">
                <div :class="{'opacity-30': listing.deleted_at}">
                    <div class="xl:flex items-center gap-2">
                        <Price :price="listing.price" class="text-2xl font-medium" />
                        <ListingSpace :listing="listing" />
                    </div>
                    <ListingAddress :listing="listing" class="text-gray-500" />
                </div>
                <div class="flex gap-1 items-center text-gray-600 dark:text-gray-300">
                    <a :href="route('listings.show', {listing: listing.id})" target="_blank" class="btn-outline text-xs font-medium">Preview</a>
                    <Link :href="route('realtor.listings.edit', {listing: listing.id})" class="btn-outline text-xs font-medium">Edit</Link>
                    <Link v-if="!listing.deleted_at" as="button" method="delete" :href="route('realtor.listings.destroy', {listing: listing.id})" class="btn-outline text-xs font-medium">Delete</Link>
                    <Link v-else as="button" method="put" :href="route('realtor.listings.restore', {listing: listing.id})" class="btn-outline text-xs font-medium">Reset</Link>
                </div>
            </div>
        </Box>
    </section>
    <section>
        <div v-if="listings.data.length" class="w-full flex justify-center my-4">
            <Pagination :links="listings.links" />
        </div>
    </section>
</template>

<script setup>

import ListingAddress from '@/Components/listingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import Pagination from '@/Components/UI/Pagination.vue'
import { Link } from '@inertiajs/inertia-vue3'
import RealtorFilter from './Index/Components/RealtorFilter.vue'
// import {Link} from 'vue'
defineProps({
    listings: Object,
    filters: Object,
})

</script>