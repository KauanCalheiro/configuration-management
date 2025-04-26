<div>
    <h1>{{ __('Task Updated') }}</h1>
    <p>{{ __('The task has been updated. Here are the details:') }}</p>

    <table border="1"
        style="border-collapse: collapse; width: 100%; font-family: Arial, sans-serif; font-size: 14px; text-align: left;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="padding: 8px; border: 1px solid #ddd;">{{ __('Attribute') }}</th>
                <th style="padding: 8px; border: 1px solid #ddd;">{{ __('Old Value') }}</th>
                <th style="padding: 8px; border: 1px solid #ddd;">{{ __('New Value') }}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;"><strong>{{ __('Description:') }}</strong></td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $oldTask->description }}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $newTask->description }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;"><strong>{{ __('Status:') }}</strong></td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $oldTask->status }}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">{{ $newTask->status }}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;"><strong>{{ __('Created At:') }}</strong></td>
                <td style="padding: 8px; border: 1px solid #ddd;">
                    {{ $oldTask->created_at ? $oldTask->created_at->format('d/m/Y') : __('N/A') }}
                </td>
                <td style="padding: 8px; border: 1px solid #ddd;">
                    {{ $newTask->created_at ? $newTask->created_at->format('d/m/Y') : __('N/A')}}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;"><strong>{{ __('Due Date:') }}</strong></td>
                <td style="padding: 8px; border: 1px solid #ddd;">
                    {{ $oldTask->due_date ? $oldTask->due_date->format('d/m/Y') : __('N/A')}}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">
                    {{ $newTask->due_date ? $newTask->due_date->format('d/m/Y') : __('N/A')}}</td>
            </tr>
            <tr>
                <td style="padding: 8px; border: 1px solid #ddd;"><strong>{{ __('Completed At:') }}</strong></td>
                <td style="padding: 8px; border: 1px solid #ddd;">
                    {{ $oldTask->completed_at ? $oldTask->completed_at->format('d/m/Y') : __('N/A')}}</td>
                <td style="padding: 8px; border: 1px solid #ddd;">
                    {{ $newTask->completed_at ? $newTask->completed_at->format('d/m/Y') : __('N/A')}}</td>
            </tr>
        </tbody>
    </table>

    <p>{{ __('Thank you!') }}</p>
</div>