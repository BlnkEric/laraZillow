<template>
    <Box>
        <template #header>
            Uploade Images
        </template>
        <form class="flex items-center gap-1" @submit.prevent="upload">
            <input type="file" multiple @input="addFiles" />
            <button type="submit" class="btn-outline">Send</button>
            <button type="reset" class="btn-outline" @click="reset">Reset</button>
        </form>
    </Box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import { useForm } from '@inertiajs/inertia-vue3'

const props = defineProps({
    listing: Object,
})

const imageForm = useForm({
    images: [],
})

const upload = () => {
    imageForm.post(route('realtor.listings.image.store', { listing: props.listing.id})),
    {
        onSuccess: imageForm.reset('images'),

    }
}

const addFiles = (event) => {
    for (const image of event.target.files) {
        imageForm.images.push(image)
    }
}

const reset = () => {
    imageForm.reset('images')
}

</script>