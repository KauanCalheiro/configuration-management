<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model {
    use SoftDeletes, HasFactory;

    public $table = 'tasks';

    public $fillable = [
        'description',
        'status',
        'created_at',
        'due_date',
        'completed_at',
    ];

    protected $hidden = [
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime:Y-m-d',
        'due_date' => 'datetime:Y-m-d',
        'created_at' => 'datetime:Y-m-d',
    ];
}
