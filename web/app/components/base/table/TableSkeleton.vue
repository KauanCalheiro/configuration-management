<template>
	<div class="flex flex-col items-center justify-center p-3 gap-3">
		<template v-for="n in skeletonRows">
			<div class="w-full flex flex-row gap-3">
				<template v-for="m in skeletonColumns">
					<!-- :class="`min-w-${skeletonColumnsWidth[m - 1]}/12 h-10`" -->
					<USkeleton
						:class="`w-full h-10`"
					/>
					<!-- FIXME: NÃO ESTÁ BUSCANDO A LARGURA DINAMICAMENTE POR m-${x}/12 -->
				</template>
			</div>
		</template>
	</div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import type Column from "~~/types/ui/Column";

const props = defineProps<{
	columns: Column[];
	rows: number;
}>();

const skeletonColumns = ref(props.columns.length);
const skeletonRows = ref(props.rows);

const skeletonColumnsWidth = computed(() => {
	const columnsWidth = props.columns.map((column) =>
		column.label.length ? column.label.length : 2
	);
	const totalWidth = columnsWidth.reduce((a, b) => a + b, 0);
	return columnsWidth.map((columnWidth) =>
		Math.round((columnWidth / totalWidth) * 12)
	);
});
</script>
