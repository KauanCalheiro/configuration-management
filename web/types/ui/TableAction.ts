export default interface TableAction<T = any> {
    key: 'edit' | 'delete' | 'view'
    label?: string
    icon: string
}
