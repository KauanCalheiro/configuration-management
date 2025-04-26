<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        User::create([
            'name' => 'Kauan',
            'email' => 'kauan.calheiro@universo.univates.br',
            'password' => bcrypt('admin'),
        ]);

        Role::create([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        User::first()->assignRole('admin');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('admin_user');
    }
};
