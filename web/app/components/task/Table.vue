<script setup lang="ts">
import AsyncDataRequestStatusEnum from "~~/enum/AsyncDataRequestStatus";
import type Task from "~~/types/Task";
import type ApiResponse from "~~/types/ApiResponse";
import type { TableColumn } from "@nuxt/ui";
import type { AsyncDataRequestStatus, NuxtError } from "#app";

const route = useRoute();

const emit = defineEmits<{
  add: [];
  edit: [row: Task];
  delete: [row: Task];
  pdf: [row: Task];
}>();

const sort = computed(() => (route.query.sort as string) ?? "id");
const page = computed(() => (route.query.page as string) ?? 1);
const search = computed(() => (route.query.search as string) ?? "");

const columns: TableColumn<Task>[] = [
  {
    header: ({ column }) => getTableHeader<Task>("ID", column),
    accessorKey: "id",
  },
  {
    header: ({ column }) => getTableHeader<Task>("Descrição", column),
    accessorKey: "description",
  },
  {
    header: ({ column }) => getTableHeader<Task>("Status", column),
    accessorKey: "status",
  },
  {
    header: ({ column }) => getTableHeader<Task>("Vencedo Em", column),
    accessorKey: "due_date",
  },
  {
    header: ({ column }) => getTableHeader<Task>("Concluído Em", column),
    accessorKey: "completed_at",
  },
  {
    header: ({ column }) => getTableHeader<Task>("Criado Em", column),
    accessorKey: "created_at",
  },
  useTableActions<Task>(emit, [
    {
      key: "pdf",
      label: "Exportar PDF",
      icon: "material-symbols:picture-as-pdf",
      color: "warning",
    },
  ]),
];

function onEdit(row: Task) {
  emit("edit", row);
}

function onDelete(row: Task) {
  emit("delete", row);
}

function fetch(page: string, sort: string, search: string) {
  return useSanctumFetch<ApiResponse<Task[]>>("/task", {
    method: "GET",
    query: {
      "page[number]": page,
      sort: sort,
      "filter[search]": search,
    },
  });
}

async function fetchData() {
  status.value = AsyncDataRequestStatusEnum.PENDING;
  var response = await fetch(page.value, sort.value, search.value);
  data.value = response.data.value ?? null;
  error.value = response.error.value ?? null;
  status.value = response.status.value;
}

const data = ref<ApiResponse<Task[]> | null>(null);
const error = ref<NuxtError<unknown> | null>(null);
const status = ref<AsyncDataRequestStatus | null>(null);

watchEffect(async () => {
  await fetchData();
});

defineExpose({
  fetchData,
});
</script>

<template>
  <BaseTable
    title="Tarefas"
    :loading="status === AsyncDataRequestStatusEnum.PENDING"
    :columns="columns"
    :total="data?.payload.total ?? 0"
    :current-page="data?.payload.current_page ?? 1"
    :per-page="data?.payload.per_page ?? 10"
    :rows="data?.payload.data ?? []"
    :status="status ?? AsyncDataRequestStatusEnum.IDLE"
    :error="error?.message"
    :use-actions="true"
    @edit="onEdit"
    @delete="onDelete"
    @add="$emit('add')"
  />
</template>
