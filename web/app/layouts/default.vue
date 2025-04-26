<template>
    <UContainer class="w-full min-h-screen">
        <BaseHeader />
        <slot/>
    </UContainer>
</template>

<script setup></script>

<style scoped>
main {
    display: flex;
    flex-direction: column;
    flex-wrap: nowrap;
}
</style>
