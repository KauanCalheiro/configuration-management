<template>
  <UContainer class="w-full h-full resize-none">
    <slot />
  </UContainer>
</template>

<script setup lang="ts">
useHead({
  meta: [
    {
      name: "viewport",
      content:
        "width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover",
    },
  ],
});
</script>

<style scoped>
main {
  display: flex;
  flex-direction: column;
  flex-wrap: nowrap;
}
</style>
