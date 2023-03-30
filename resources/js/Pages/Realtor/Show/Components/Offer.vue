<template>
    <Box>
        <template #header>
            <div class="flex items-center gap-3">
                Offer # {{ offer.id }} 
                <span 
                    v-if="offer.accepted_at" 
                    class="dark:bg-green-900 text-green-200 bg-green-300 p-1 text-xs font-medium rounded-md uppercase"
                >
                    Accepted
                </span>
            </div>
        </template>
        
        <section class="flex items-center justify-between">
            <div>
                <!-- HO -->
                <!-- {{ offer.amount }} -->
                <Price :price="offer.amount" class="text-xl font-medium" />
                <div class="text-gray-500">
                    difference <Price :price="difference" />
                </div>
                <div class="text-gray-500">
                    Made By : {{ offer.bidder.name }}
                </div>
                <div class="text-gray-500">
                    Made On {{ madeOn }}
                </div>
            </div>
            <div>
                <Link 
                    v-if="notSold"
                    :href="route('realtor.offer.accept', {offer: offer.id})"
                    class="btn-outline font-medium text-xs" 
                    as="button"
                    method="put"
                >
                    Accept
                </Link>
            </div>
        </section>
    </Box>
</template>

<script setup>
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { Link } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'

const props = defineProps({
    offer: Object,
    listingPrice: Number,
    notSold: Boolean,
})

const difference = computed(() => props.offer.amount - props.listingPrice)
const madeOn = computed(() => new Date(props.offer.created_at).toDateString())
// const notSold = computed(() => !props.offer.accepted_at && !props.offer.rejected_at)

</script>