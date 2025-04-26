<script setup lang="ts">
import { createReusableTemplate, useMediaQuery } from "@vueuse/core";

const isOpen = defineModel<boolean>();
const isDesktop = useMediaQuery("(min-width: 768px)");
const [DefineTemplate, ReuseTemplate] = createReusableTemplate();

const {
  acceptText = "Sim",
  declineText = "Não",
  acceptLoading = false,
} = defineProps<{
  acceptText?: string;
  declineText?: string;
  acceptLoading?: boolean;
}>();

const emit = defineEmits<{
  accept: [];
  decline: [];
}>();
</script>

<template>
  <DefineTemplate>
    <div class="flex flex-col gap-8 items-center p-12">
      <slot />
      <div class="flex flex-row gap-4 justify-between md:justify-end w-full">
        <UButton
          @click="emit('decline')"
          color="neutral"
          variant="soft"
          size="xl"
          class="min-w-24 flex justify-center"
        >
          <slot name="decline">{{ declineText }}</slot>
        </UButton>
        <UButton
          @click="emit('accept')"
          trailing
          loading-icon="svg-spinners:90-ring-with-bg"
          :loading="acceptLoading"
          color="primary"
          variant="soft"
          size="xl"
          class="min-w-24 flex justify-center"
        >
          <slot name="accept">{{ acceptText }}</slot>
        </UButton>
      </div>
    </div>
  </DefineTemplate>

  <UModal v-if="isDesktop" v-model:open="isOpen" :dismissible="false">
    <template #content>
      <ReuseTemplate />
    </template>
  </UModal>
  <UDrawer v-else v-model:open="isOpen" :dismissible="false">
    <template #body>
      <ReuseTemplate />
    </template>
  </UDrawer>
</template>
