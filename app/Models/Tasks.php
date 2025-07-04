<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{   // Allow mass assignment on the 'task' attribute **only tasks can be mass-assagined**
    protected $fillable = ['task', 'completed'];

    /** @use HasFactory<\Database\Factories\TasksFactory> */
    use HasFactory;
}
