<template>
    <img
        :class="[width, 'filter drop-shadow-[3px_2px_1px_#000]']"
        src="public/logo.png"
        alt="Logo"
    >
</template>

<script setup lang="ts">
const {width = 'w-[150px]'} = defineProps<{
    width?: string
}>();
</script>