<style>
    @media print {
        @page {
            margin: 0;
            padding: 0;
        }

        body {
            margin: 0;
            padding: 0;
        }
    }

    @page {
        margin: 0;
        padding: 0;
    }

    body {
        margin: 0;
        padding: 0;
    }
</style>

<div style="background-color: #e8e8e8; padding: 20px; min-height: 100vh; min-width: 100vw;">
    <div
        style="margin: 20px auto; padding: 20px; border: unset; border-radius: 5px; background-color: #fff; max-width: 800px;">
        <h1 style="font-family: Arial, sans-serif; color: #333;">{{ __('Task') }}</h1>

        <table border="1" style="border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; font-size: 14px; text-align: left;">
            <tbody>
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd;"><strong>{{ __('Description:') }}</strong></td>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $task->description }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd;"><strong>{{ __('Status:') }}</strong></td>
                    <td style="padding: 8px; border: 1px solid #ddd;">{{ $task->status }}</td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd;"><strong>{{ __('Created At:') }}</strong></td>
                    <td style="padding: 8px; border: 1px solid #ddd;">
                        {{ $task->created_at ? $task->created_at->format('d/m/Y') : __('N/A') }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd;"><strong>{{ __('Due Date:') }}</strong></td>
                    <td style="padding: 8px; border: 1px solid #ddd;">
                        {{ $task->due_date ? $task->due_date->format('d/m/Y') : __('N/A') }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd;"><strong>{{ __('Completed At:') }}</strong></td>
                    <td style="padding: 8px; border: 1px solid #ddd;">
                    {{ $task->completed_at ? $task->completed_at->format('d/m/Y') : __('N/A') }}
                    </td>
                </tr>
                <tr>
                    <td style="padding: 8px; border: 1px solid #ddd;"><strong>{{ __('Updated At:') }}</strong></td>
                    <td style="padding: 8px; border: 1px solid #ddd;">
                    {{ $task->updated_at ? $task->updated_at->format('d/m/Y') : __('N/A') }}
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>