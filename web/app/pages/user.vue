<script setup lang="ts">
import { UserTable } from "#components";
import type User from "~~/types/User";

const isFormOpen = ref<boolean>(false);
const isExcludeOpen = ref<boolean>(false);

const refUserTable = ref();

const userToPerformAction = ref<User | undefined>(undefined);

function onAdd() {
  console.log("onAdd");
  userToPerformAction.value = undefined;
  openForm();
}

function onEdit(row: User) {
  console.log("onEdit", row);
  userToPerformAction.value = row;
  openForm();
}

function onDelete(row: User) {
  userToPerformAction.value = row;
  openExclude();
}

async function onAfterSave() {
  closeForm();
  await refUserTable.value.fetchData();
}

function onAfterDelete() {
  refUserTable.value.fetchData();
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
  <UserTable
    ref="refUserTable"
    @add="onAdd"
    @edit="onEdit"
    @delete="onDelete"
  />

  <UDrawer v-model:open="isFormOpen">
    <template #body>
      <UserForm
        @after-save="onAfterSave"
        @cancel="closeForm"
        :user="userToPerformAction"
      ></UserForm>
    </template>
  </UDrawer>

  <UserDelete
    v-model="isExcludeOpen"
    :user="(userToPerformAction ?? {} as User)"
    @after-delete="onAfterDelete"
  />
</template>
