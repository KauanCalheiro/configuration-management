<?php

namespace App\Mail;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UpdatedTask extends Mailable
{
    use Queueable, SerializesModels;

    public Task $oldTask;
    public Task $newTask;

    /**
     * Create a new message instance.
     */
    public function __construct(Task $oldTask, Task $newTask)
    {
        $this->oldTask = $oldTask;
        $this->newTask = $newTask;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: __('Updated Task'),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'updated_task',
            with: [
                'oldTask' => $this->oldTask,
                'newTask' => $this->newTask,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
