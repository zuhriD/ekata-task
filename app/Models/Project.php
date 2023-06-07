<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'project_title',
        'task_type',
        'stack',
        'project_description',
        'assigned_to',
        'deadline',
        'price',
        'progress',
    ];
}
