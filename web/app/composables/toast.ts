
const toastId = 'protocol-toast-id'

const colorToastSuccess = 'success'
const colorToastError = 'error'
const colorToastWarning = 'warning'
const colorToastInfo = 'info'
const colorToastNotify = 'neutral'

let toastCount = 0

function generateToastId() {
    toastCount++
    return `${toastId}-${Date.now()}-${toastCount}`
}

export function toast() {
    const toast = useToast()

    const baseAdd = ({
        description,
        title,
        icon,
        color
    }: {
        description: string,
        title: string,
        icon: string,
        color: "error" | "primary" | "secondary" | "success" | "info" | "warning" | "neutral"
    }) => {
        toast.add({
            id: generateToastId(),
            title,
            description,
            icon,
            color,
            
        })
    }

    const methods = {
        success: ({
            description,
            title = 'Sucesso',
            icon = 'material-symbols:check-circle'
        }: {
            description: string,
            title?: string,
            icon?: string
        }) => { baseAdd({ description, title, icon, color: colorToastSuccess }) },

        error: ({
            description,
            title = 'Erro',
            icon = 'material-symbols:dangerous'
        }: {
            description: string,
            title?: string,
            icon?: string
        }) => { baseAdd({ description, title, icon, color: colorToastError }) },

        warning: ({
            description,
            title = 'Atenção',
            icon = 'material-symbols:warning'
        }: {
            description: string,
            title?: string,
            icon?: string
        }) => { baseAdd({ description, title, icon, color: colorToastWarning }) },

        info: ({
            description,
            title = 'Informação',
            icon = 'material-symbols:info'
        }: {
            description: string,
            title?: string,
            icon?: string
        }) => { baseAdd({ description, title, icon, color: colorToastInfo }) },

        notify: ({
            description,
            title = 'Notificação',
            icon = 'material-symbols:notifications'
        }: {
            description: string,
            title?: string,
            icon?: string
        }) => { baseAdd({ description, title, icon, color: colorToastNotify }) },
    }

    const { success, error, warning, info, notify } = methods

    return {
        success,
        error,
        warning,
        info,
        notify,
    }
}
