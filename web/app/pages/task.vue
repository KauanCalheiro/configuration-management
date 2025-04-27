<script setup lang="ts">
import { TaskTable } from "#components";
import type ApiResponse from "~~/types/ApiResponse";
import type Task from "~~/types/Task";

const isFormOpen = ref<boolean>(false);
const isExcludeOpen = ref<boolean>(false);

const refTaskTable = ref();

const taskToPerformAction = ref<Task | undefined>(undefined);

function onAdd() {
  console.log("onAdd");
  taskToPerformAction.value = undefined;
  openForm();
}

function onEdit(row: Task) {
  console.log("onEdit", row);
  taskToPerformAction.value = row;
  openForm();
}

function onDelete(row: Task) {
  taskToPerformAction.value = row;
  openExclude();
}

async function onPdf(row: Task) {
  try {
    const { data, error } = await useSanctumFetch<Blob>(`/task/${row.id}/pdf`, {
      method: "GET",
      headers: { "Accept": "application/pdf" },
      responseType: "blob",
    });

    if (error.value || typeof data.value !== 'object') {
      throw new Error();
    }

    const url = URL.createObjectURL(data.value);
    const a = document.createElement("a");
    a.href = url;
    a.download = `task-${row.id}.pdf`;
    a.click();
    URL.revokeObjectURL(url);

    toast().success({ description: "PDF gerado com sucesso" });

  } catch {
    const error: any = useNuxtApp().$lastSanctumError;
    toast().error({
      description: error?.value?._data?.message || "Ocorreu um erro",
    });
  }
}


async function onAfterSave() {
  closeForm();
  await refTaskTable.value.fetchData();
}

function onAfterDelete() {
  refTaskTable.value.fetchData();
}

function openForm() {
  isFormOpen.value = true;
}

function closeForm() {
  isFormOpen.value = false;
}

function openExclude() {
  isExcludeOpen.value = true;
}
</script>

<template>
  <TaskTable
    ref="refTaskTable"
    @add="onAdd"
    @edit="onEdit"
    @delete="onDelete"
    @pdf="onPdf"
  />

  <UDrawer v-model:open="isFormOpen">
    <template #body>
      <TaskForm
        @after-save="onAfterSave"
        @cancel="closeForm"
        :task="taskToPerformAction"
      ></TaskForm>
    </template>
  </UDrawer>

  <TaskDelete
    v-model="isExcludeOpen"
    :task="(taskToPerformAction ?? {} as Task)"
    @after-delete="onAfterDelete"
  />
</template>
