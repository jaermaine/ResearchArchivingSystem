<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentStudent extends Model
{
    protected $table = 'document_student'; // Ensure this is 'faculty' and not 'faculties'

    protected $fillable = [
        'document_id',
        'student_id',
    ];

}
