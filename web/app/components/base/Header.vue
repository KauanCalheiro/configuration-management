<script setup lang="ts">
function onClickLogo() {
  useRouter().push({
    path: "/",
  });
}
</script>

<template>
  <div class="flex flex-row p-4 w-full justify-between items-center">
    <BaseThornLogo class="hover:cursor-pointer" @click="onClickLogo" />
    <BaseSideMenu />
  </div>
</template>
