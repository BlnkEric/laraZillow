<template>
  <div>
    Main Page
  </div>
  <div>{{ message }}</div>
</template>

<script setup>
defineProps({
    message : String,
})
</script>