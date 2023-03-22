<template>
    <div class="flex flex-col-reverse md:grid md:grid-cols-12 gap-4  mx-5">
        <Box class="md:col-span-7 flex items-center w-full">
            <div v-if="!listing.images.length" class="w-full text-center font-medium text-gray-500">
                No images Yet
            </div>
            <div v-else class="grid grid-cols-3 gap-1">
                <img v-for="image in listing.images" :key="image.id" :src="image.src" alt="" />
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
                    Monthly Payment
                </template>
                <div>
                    <label class="label">Increase rate ({{ interestRate }})</label>
                    <input v-model.number="interestRate" type="range" min="0.1" max="30" step="0.1" class="w-full h-4 bg-gray-300 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer" />
                    
                    <label class="label">Duration ({{ duration }} years)</label>
                    <input v-model.number="duration" type="range" min="3" max="30" step="1" class="w-full h-4 bg-gray-300 dark:bg-gray-700 rounded-lg appearance-none cursor-pointer" />
                    
                    <div class="text-gray-600 dark:text-gray-300 mt-2">
                        <div class="text-gray-400">
                            Your Monthly Payment
                        </div>
                        <Price :price="monthlyPayment" class="font-bold text-3xl" />
                    </div>
                    <div class="text-gray-500 mt-2">
                        <div class="flex justify-between">
                            <div>total paid</div>
                            <div class="font-bold">
                                <Price :price="totalPaid" />
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div>principal paid</div>
                            <div class="font-bold">
                                <Price :price="listing.price" />
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div>interest paid</div>
                            <div class="font-bold">
                                <Price :price="totalInterest" />
                            </div>
                        </div>
                    </div>
                </div>
            </Box>
        </div>
    </div>
</template>

<script setup>
import ListingAddress from '@/Components/listingAddress.vue'
import ListingSpace from '@/Components/ListingSpace.vue'
import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { ref } from 'vue'
import { useMonthlyPayment } from '@/Composables/useMonthlyPayment'

const interestRate = ref(2.5)
const duration = ref(25)

const props = defineProps({
    listing : Object,
})

const { monthlyPayment, totalPaid, totalInterest } = useMonthlyPayment(props.listing.price, interestRate, duration)

</script>
