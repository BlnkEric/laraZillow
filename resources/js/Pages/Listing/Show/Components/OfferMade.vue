
<template>
    <Box>
        <template #header>
            Offer Made
        </template>
        <Price :price="offer.amount" />
        <section class="flex flex-col md:flex-row justify-between text-gray-500">
            <div>
                offer made on:
            </div>
            <div class="font-medium">
                {{ offerMadeOn }}
            </div>
        </section>
    </Box>
</template>

<script setup>

import Price from '@/Components/Price.vue'
import Box from '@/Components/UI/Box.vue'
import { computed } from 'vue'

const props = defineProps({
    offer:Object,
})

const offerMadeOn = computed(
    () => new Date(props.offer.created_at).toDateString(),
)

</script>