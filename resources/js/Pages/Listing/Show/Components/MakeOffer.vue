<template>
    <Box>
        <template #header>
            Make Offer
        </template>
        <div>
            <form @submit.prevent="makeOffer">
                <input v-model.number="form.amount" type="text" class="input" />
                <input
                    v-model.number="form.amount"
                    type="range" :min="min" :max="max" step="10000" 
                    class="mt-2 w-full h-4 bg-gray-300 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer"
                />
                
                <button class="btn-outline w-full mt-2 text-sm" type="submit">Submit</button>
            </form>
            <div class="flex justify-between text-gray-500 mt-2">
                <div>
                    Difference
                </div>
                <div>
                    <Price :price="difference" />
                </div>
            </div>

            {{ form.errors.amount }}
        </div>
    </Box>
</template>

<script setup>
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { useForm } from '@inertiajs/inertia-vue3'
import { computed } from 'vue'

const props = defineProps({
    listingId: Number,
    price: Number,
})

const form = useForm({
    amount: props.price,
})

const makeOffer = () => form.post(
    route('listings.offers.store', {listing: props.listingId}),
    {
        preserveScroll: true,
        preserveState: true,
    },
)

const difference = computed(() => form.amount - props.price)
const min = computed(() => Math.round(props.price / 2))
const max = computed(() => Math.round(props.price * 2))

</script>