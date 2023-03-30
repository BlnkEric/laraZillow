<template>
    <Box>
        <div>
            ## {{ listing.id }}
            <Link :href="route('listings.show', {listing: listing.id})">
                <div v-if="listing.sold_at != null" class="text-xs font-bold uppercase border border-dashed dark:border-green-700 dark:text-green-700 text-green-500 p-1 rounded-md inline-block">sold</div>
                <div class="xl:flex items-center gap-2">
                    <Price :price="listing.price" class="font-bold text-2xl" />
                    <div class="text-xs text-gray-500">
                        <Price :price="monthlyPayment" />pm
                    </div>
                </div>
                <ListingSpace :listing="listing" class="text-lg" />
                <ListingAddress :listing="listing" class="text-gray-500" />
            </Link>
        </div>
    </Box>
</template>

<script setup>
import { Link } from '@inertiajs/inertia-vue3'
import ListingAddress from '@/Components/listingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { useMonthlyPayment } from '@/Composables/useMonthlyPayment'


const props = defineProps({
    listing : Object,
})

const { monthlyPayment } = useMonthlyPayment(props.listing.price, 2.5, 25)

</script>
