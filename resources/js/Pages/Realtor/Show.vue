<template>
    <div class="m-4">
        <Link :href="route('realtor.listings.index')"> Go back to listings</Link>
    </div>

    <section class="flex flex-col-reverse md:grid grid-cols-12 gap-4">
        <Box v-if="!hasOffers" class="flex md:col-span-7 items-center">
            <div class="w-full text-center font-medium text-gray-500">
                No offers
            </div>
        </Box>

        <div v-else class="flex md:col-span-7 items-center">
            This is for existing offers ! 
        </div>
        <Box class="md:col-span-5">
            <template #header>
                WE HERE
            </template>
            <Price :price="listing.price" />
            <ListingSpace class="text-lg" :listing="listing" />
            <ListingAddress class="text-gray-500" :listing="listing" />
        </Box>
    </section>
</template>

<script setup>
import ListingAddress from '@/Components/listingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { Link } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'

const props = defineProps({
    listing: Object,
})

const hasOffers = computed(() => props.listing.offers.length)

</script>