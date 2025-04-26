import { UButton, UDropdownMenu } from "#components";
import type { DropdownMenuItem, TableColumn } from "@nuxt/ui";

let t: DropdownMenuItem

export function useTableActions<T>(
    emit: (event: any, row: any) => void,
    custonItem?: DropdownMenuItem[]
): TableColumn<T> {
    return {
        id: "actions",
        cell: ({ row }) => {
            return h(
                "div",
                { class: "text-right" },
                h(
                    UDropdownMenu as any,
                    {
                        content: {
                            align: "end",
                        },
                        items: [
                            {
                                key: "edit",
                                label: "Editar",
                                icon: "material-symbols:edit",
                                color: "info",
                                onSelect: () => {
                                    emit("edit", row.original)
                                },
                            },
                            {
                                key: "delete",
                                label: "Excluir",
                                icon: "material-symbols:delete",
                                color: "error",
                                onSelect: () => emit("delete", row.original),
                            },
                            ...(custonItem
                                ? custonItem.map((item) => ({
                                    ...item,
                                    onSelect: () => emit(item.key, row.original),
                                }))
                                : []
                            ),
                        ],
                        "aria-label": "Actions dropdown",
                    },
                    () =>
                        h(UButton, {
                            icon: "i-lucide-ellipsis-vertical",
                            color: "neutral",
                            variant: "ghost",
                            class: "ml-auto",
                            "aria-label": "Actions dropdown",
                        })
                )
            );
        },
    };
}