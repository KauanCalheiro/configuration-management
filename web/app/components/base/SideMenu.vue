<script setup lang="ts">
const isOpen = ref(false);

import { useMediaQuery } from "@vueuse/core";
const isDesktop = useMediaQuery("(min-width: 768px)");
</script>

<template>
  <UDrawer v-model:open="isOpen" :direction="isDesktop ? 'right' : 'bottom'">
    <UButton
      icon="material-symbols:menu-rounded"
      size="lg"
      color="neutral"
      variant="ghost"
      @click="isOpen = true"
    />
    <template #header>
      <div class="w-full flex flex-row justify-between">
        <div />
        <BaseButtonLogout />
      </div>
    </template>
    <template #body>
      <div class="flex flex-col gap-4 h-full min-h-[50vh] min-w-[20vw]">
        <ULink href="/user">Usuarios</ULink>
        <ULink href="/task">Tarefas</ULink>
      </div>
    </template>
    <template #footer>
      <div class="w-full h-fit p-2 flex flex-row justify-center">
        <BaseThornLogo />
      </div>
    </template>
  </UDrawer>
</template>
