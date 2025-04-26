export function useSort(column: string, direction: 'asc' | 'desc' | string ) {
    return `${direction === "desc" ? "-" : ""}${column}`;
}