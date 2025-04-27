<script setup lang="ts">
import type User from "~~/types/User";
import type { $Fetch } from "ofetch";

const { user } = defineProps<{ user: User }>();
const emit = defineEmits(["after-delete"]);
const isOpen = defineModel<boolean>();

function onDelete() {
  const fetch: $Fetch = useSanctumClient();
  fetch(`/user/${user.id}`, { method: "DELETE" })
    .then(() => {
      isOpen.value = false;
      emit("after-delete");
    })
    .catch(() => {
      let error: any = useNuxtApp().$lastSanctumError;
      toast().error({
      description: error?.value?._data?.message || "Ocorreu um erro",
    });
    });
}

const onCancel = () => {
  isOpen.value = false;
};
</script>

<template>
  <BaseQuest
    v-model="isOpen"
    @accept="onDelete"
    @decline="onCancel"
    accept-text="Excluir usuário"
    decline-text="Cancelar"
  >
    Confirme a exclusão do usuário <strong
      >"{{ user.id }} - {{ user.name }}"</strong
    >
  </BaseQuest>
</template>
