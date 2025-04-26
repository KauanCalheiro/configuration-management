<script setup lang="ts" generic="T">
import type { TableColumn } from "@nuxt/ui";
import AsyncDataRequestStatusEnum from "~~/enum/AsyncDataRequestStatus";
import type { SortingState } from "~~/types/ui/Sort";
import type TableSort from "~~/types/ui/TableSort";

const { title, columns, rows, status, total, currentPage, perPage } =
  defineProps<{
    title?: string;
    columns: TableColumn<T, unknown>[];
    rows: T[];
    status: string;
    total: number;
    currentPage?: number;
    perPage?: number;
  }>();

const route = useRoute();

const table = useTemplateRef("table");

const search = ref<string>("");
search.value = (route.query.search as string) ?? "";

const emit = defineEmits<{
  "update:sort": [sort: TableSort];
  add: [];
  edit: [row: T];
  delete: [row: T];
}>();

const loading = computed(
  () =>
    status == AsyncDataRequestStatusEnum.IDLE ||
    status == AsyncDataRequestStatusEnum.PENDING
);

async function onUpdateSort(sort: SortingState) {
  await navigateTo({
    path: route.path,
    query: {
      ...route.query,
      sort: useSort(sort[0]?.id ?? "id", sort[0]?.desc ? "desc" : "asc"),
    },
  });
}

async function onUpdatePage(page: number) {
  await navigateTo({
    path: route.path,
    query: {
      ...route.query,
      page: page,
    },
  });
}

async function onUpdateSearch() {
  await navigateTo({
    path: route.path,
    query: {
      ...route.query,
      search: search.value,
      page: 1,
    },
  });
}

watch(search, async (newValue) => {
  await onUpdateSearch();
});
</script>

<template>
  <div
    class="flex flex-col w-full mx-auto gap-4 py-4 px-8 rounded-lg shadow-xl/50 mb-5 border-1 border-neutral-800"
  >
    <div class="flex flex-col gap-2">
      <BaseTitle v-if="title" :title="title" />
      <div class="flex flex-row gap-4 justify-between w-full">
        <UInput
          icon="i-lucide-search"
          class="shadow-xl/15 md:w-4/10"
          size="md"
          variant="soft"
          placeholder="Buscar..."
          v-model="search"
          :ui="{
            trailing: 'p-0.5',
          }"
        >
          <template #trailing v-if="search.length > 0" class="p-5">
            <UButton
              icon="i-lucide-circle-x"
              size="sm"
              color="error"
              variant="ghost"
              @click="search = ''"
            />
          </template>
        </UInput>
        <UButton
          icon="material-symbols:add"
          size="md"
          color="primary"
          variant="soft"
          class="flex items-center shadow-xl/15"
          @click="emit('add')"
        >
          Novo
        </UButton>
      </div>
    </div>
    <UTable
      ref="table"
      sticky
      :columns="columns"
      :data="rows"
      :loading="loading"
      @update:sorting="onUpdateSort"
      class="h-[70dvh]"
    />
    <div class="flex justify-center">
      <UPagination
        :page="currentPage"
        :default-page="
          (table?.tableApi?.getState().pagination.pageIndex || 0) + 1
        "
        :items-per-page="perPage"
        :total="total"
        @update:page="onUpdatePage"
      />
    </div>
  </div>
</template>
