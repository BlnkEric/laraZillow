<template>
    <form method="post" :action="route('realtor.listings.image.store', {listing: listing.id})">
        <input type="file" multiple name="files" />
        <button type="submit">Send</button>
    </form>
</template>

<script setup>

const props = defineProps({
    listing: Object,
})
</script>