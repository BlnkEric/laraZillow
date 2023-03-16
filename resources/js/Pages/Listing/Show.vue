<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4">
        <Box class="md:col-span-7 flex items-center w-full">
            <div class="w-full text-center font-medium text-gray-500">
                No images Yet
            </div>
        </Box>
        <div class="flex flex-col md:col-span-5 gap-4">
            <Box>
                <template #header>
                    Basic Info
                </template>
                <Price :price="listing.price" class="font-bold text-2xl" />
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-gray-500" />
            </Box>
            <Box>
                <template #header>
                    Offer
                </template>
                <Price :price="listing.price" class="font-bold text-2xl" />
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-gray-500" />
            </Box>
        </div>
    </div>
</template>

<script setup>
import ListingAddress from '../Components/listingAddress.vue'
import ListingSpace from '../Components/ListingSpace.vue'
import Price from '../Components/Price.vue'
import Box from '../Components/UI/Box.vue'

defineProps({
    listing : Object,
})
</script>
