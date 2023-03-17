<template>
    <div class="grid xl:grid-cols-3 md:grid-cols-2 sm:grid-cols-1 gap-4">
        <Box v-for="listing in listings" :key="listing.id" class="">
            <div>
                <Link :href="route('listings.show', {listing: listing.id})">
                    <Price :price="listing.price" class="font-bold text-2xl" />
                    <ListingSpace :listing="listing" class="text-lg" />
                    <ListingAddress :listing="listing" class="text-gray-500" />
                </Link>
            </div>
            <div>
                <Link :href="route('listings.edit', {listing: listing.id})">Edit</Link>
            </div>
            <div>
                <Link :href="route('listings.destroy', {listing: listing.id})" method="DELETE" as="button">Delete</Link>
            </div>
        </Box>
    </div>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import ListingAddress from '../../Components/listingAddress.vue'
import ListingSpace from '../../Components/ListingSpace.vue'
import Price from '../../Components/Price.vue'
import Box from '../../Components/UI/Box.vue'

defineProps({
    listings : Array,
})
</script>

<style scoped>
</style>