<script setup lang="ts">
import type Task from "~~/types/Task";
import type { $Fetch } from "ofetch";

const { task } = defineProps<{ task: Task }>();
const emit = defineEmits(["after-delete"]);
const isOpen = defineModel<boolean>();
const loading = ref(false);

async function onDelete() {
  loading.value = true;
  const fetch: $Fetch = useSanctumClient();
  fetch(`/task/${task.id}`, { method: "DELETE" })
    .then(() => {
      isOpen.value = false;
      toast().success({
        description: "Tarefa excluída com sucesso",
      });
      emit("after-delete");
    })
    .catch(() => {
      let error: any = useNuxtApp().$lastSanctumError;
      toast().error({
        description: error?.value?._data?.message || "Ocorreu um erro",
      });
    })
    .finally(() => {
      loading.value = false;
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
    :accept-loading="loading"
    accept-text="Excluir tarefa"
    decline-text="Cancelar"
  >
    Confirme a exclusão do usuário
    <strong>"{{ task.id }} - {{ task.description }}"</strong>
  </BaseQuest>
</template>
