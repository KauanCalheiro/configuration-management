<?php

namespace Tests\Feature;

use App\Mail\CreatedTask;
use App\Mail\UpdatedTask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class TaskTest extends TestCase {
    use RefreshDatabase; 

    private const TASKS_ENDPOINT = '/api/task';
    private const EXPORT_PDF_ENDPOINT = '/api/task/{task}/pdf';

    private const JSON_STRUCTURE = [
        'success',
        'message',
        'payload' => [
            'id',
            'description',
            'due_date',
            'completed_at',
            'status',
            'created_at',
        ],
        'count',
    ];

    private const JSON_STRUCTURE_PAGINATED = [
        'success',
        'message',
        'payload' => [
            'current_page',
            'data' => [
                '*' => [
                    'id',
                    'description',
                    'due_date',
                    'completed_at',
                    'status',
                    'created_at',
                ],
            ],
            'first_page_url',
            'from',
            'last_page',
            'last_page_url',
            'links',
            'next_page_url',
            'path',
            'per_page',
            'prev_page_url',
            'to',
            'total',
        ],
        'count',
    ];

    protected function authenticate() {
        $this->actingAs(User::factory()->create());
    }

    public function test_create_task_missing_fields() {
        $this->authenticate();

        $response = $this->postJson(self::TASKS_ENDPOINT, []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['description', 'status']);
    }

    public function test_update_task_invalid_id() {
        $this->authenticate();

        $response = $this->putJson(self::TASKS_ENDPOINT . "/9999", [
            'description' => 'Atualizar',
        ]);

        $response->assertStatus(404)->assertJsonStructure([
            'message',
            'exception',
            'file',
            'line',
            'trace',
        ]);
    }

    public function test_email_on_task_creation() {
        $this->authenticate();

        Mail::fake();

        $this->postJson(self::TASKS_ENDPOINT, Task::factory()->raw());

        Mail::assertSent(fn(CreatedTask $mail) => $mail->hasTo(auth()->user()->email) && $mail instanceof CreatedTask);
    }
    public function test_email_on_task_update() {
        $this->authenticate();

        Mail::fake();

        $task = Task::factory()->create();

        $this->putJson(self::TASKS_ENDPOINT . "/{$task->id}", [
            'description' => 'Atualizar descrição',
        ]);

        Mail::assertSent(fn(UpdatedTask $mail) => $mail->hasTo(auth()->user()->email) && $mail instanceof UpdatedTask);
    }

    public function test_pdf_export_task() {
        $this->authenticate();

        $task = Task::factory()->create();

        $endpoint = str_replace('{task}', $task->id, self::EXPORT_PDF_ENDPOINT);

        $response = $this->getJson($endpoint);

        $response->assertStatus(200);
        $this->assertEquals('application/pdf', $response->headers->get('Content-Type'));
        $this->assertStringStartsWith('%PDF', $response->content());
    }
}
