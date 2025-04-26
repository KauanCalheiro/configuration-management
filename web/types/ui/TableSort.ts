export default interface TableSort {
    column: string
    direction: 'asc' | 'desc' | '' | '-' | string
}
