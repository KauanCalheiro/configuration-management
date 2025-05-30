<div>
    <h1>{{ __('Task Created Successfully!') }}</h1>
    <p>{{ __('A new task has been created with the following details:') }}</p>
    <table border="1"
        style="border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; font-size: 14px; text-align: left;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 8px; border: 1px solid #ddd;">{{ __('Attribute') }}</th>
                <th style="padding: 8px; border: 1px solid #ddd;">{{ __('Value') }}</th>
            </tr>
        </thead>
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
        </tbody>
    </table>
    <p>{{ __('Thank you!') }}</p>
</div>