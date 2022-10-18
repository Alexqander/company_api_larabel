<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class workers extends Model
{
    protected $table = 'workers';
    protected $filelable = [
        'id',
        'name',
        'last_name',
        'email',
        'job_tittle',
        'salary',
        'salary_taxes',
        'category',
        'created_at',
        'updated_at'
    ];
    use HasFactory;
}
