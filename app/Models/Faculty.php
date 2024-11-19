<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $table = 'faculty'; // Ensure this is 'faculty' and not 'faculties'

    protected $fillable = [
        'first_name',
        'last_name',
        'user_id',
        'document_id',
        'department_id',
    ];
}
