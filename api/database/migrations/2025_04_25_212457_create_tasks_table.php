<?php

use App\Models\Task;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->timestamp('due_date')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->text('status')->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });

        $tarefas = [
            ['description' => 'Finalizar relatório', 'due_date' => '2025-03-27', 'completed_at' => null, 'status' => 'Em andamento'],
            ['description' => 'Revisar código', 'due_date' => '2025-03-25', 'completed_at' => '2025-03-24', 'status' => 'Concluido'],
            ['description' => 'Planejar reunião', 'due_date' => '2025-03-22', 'completed_at' => null, 'status' => 'Em andamento'],
            ['description' => 'Enviar e-mails', 'due_date' => '2025-03-17', 'completed_at' => '2025-03-16', 'status' => 'Concluido'],
            ['description' => 'Atualizar sistema', 'due_date' => '2025-03-12', 'completed_at' => null, 'status' => 'Em andamento'],
            ['description' => 'Criar apresentação', 'due_date' => '2025-03-08', 'completed_at' => '2025-03-07', 'status' => 'Concluido'],
            ['description' => 'Testar funcionalidades', 'due_date' => '2025-03-04', 'completed_at' => null, 'status' => 'Parado'],
            ['description' => 'Corrigir bugs', 'due_date' => '2025-02-27', 'completed_at' => '2025-02-26', 'status' => 'Concluido'],
            ['description' => 'Documentar projeto', 'due_date' => '2025-02-22', 'completed_at' => null, 'status' => 'Em andamento'],
            ['description' => 'Treinar equipe', 'due_date' => '2025-02-17', 'completed_at' => '2025-02-16', 'status' => 'Concluido'],
        ];

        foreach ($tarefas as $tarefa) {
            Task::create($tarefa);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
