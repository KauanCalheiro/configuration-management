import type { VNode } from "vue"

export default interface TableColumn<T> {
    accessorKey?: string & keyof T
    header?: any
    id?: string
    cell?: ({ row }: { row: T }) => VNode
    sortable?: boolean
}
