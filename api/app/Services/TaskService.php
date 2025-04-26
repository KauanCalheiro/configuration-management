<?php

namespace App\Services;

use App\Mail\CreatedTask;
use App\Mail\UpdatedTask;
use App\Models\Task;
use Illuminate\Foundation\Auth\User;
use DB;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Mail\Mailable;
use Mail;

class TaskService {
    protected ?Task $task;
    protected ?Task $oldTask;

    protected function __construct(Task $task = null) {
        $this->task = $task ?? new Task();
    }

    public static function make(Task $task = null): self {
        return new self($task);
    }

    public function save(FormRequest $data): Task {
        $data = $data->validated();

        return $this->task->exists
            ? $this->performUpdate($data)
            : $this->performStore($data);
    }

    protected function beforeStore(): void {
    }

    protected function performStore(array $data): Task {
        return DB::transaction(function () use ($data) {
            $this->beforeStore();
            $this->task = Task::create($data);
            $this->afterStore();
            return $this->task;
        }, 5);
    }

    protected function afterStore(): void {
        $this->sendMailAuthUser(new CreatedTask($this->task));
    }

    protected function beforeUpdate(): void {
        $this->oldTask = new Task($this->task->toArray());
    }

    protected function performUpdate(array $data): Task {
        DB::transaction(function () use ($data) {
            $this->beforeUpdate();
            $this->task->updateOrFail($data);
            $this->afterUpdate();
        }, 5);
        return $this->task;
    }

    protected function afterUpdate(): void {
        $this->sendMailAuthUser(new UpdatedTask($this->oldTask, $this->task));
    }

    protected function sendMailAuthUser(Mailable $mail): void {
        $this->sendMail(auth()->user(), $mail);
    }

    protected function sendMail(User $user, Mailable $mail): void {
        Mail::to($user->email)
            ->send($mail);
    }
}