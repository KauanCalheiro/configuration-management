<template>
    <h1 class="text-2xl font-bold">
        <slot>
            {{ title }}
        </slot>
    </h1>
</template>

<script setup lang="ts">
const { title } = defineProps<{ title?: string }>();
</script>
