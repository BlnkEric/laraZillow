<template>
    <div>
        <span class="font-bold">{{ listing.beds }}</span> beds <span class="text-gray-500"> | </span>
        <span class="font-bold">{{ listing.baths }}</span> baths <span class="text-gray-500"> | </span>
        <span class="font-bold">{{ listing.area }}</span> m^2 <span class="text-gray-500" />
    </div>
</template>
  
<script setup>
defineProps({
    listing : Object,
})
</script>