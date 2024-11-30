<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $table = 'documents'; // Ensure this is 'faculty' and not 'faculties'

    protected $fillable = [
        'title',
        'abstract',
        'field_topic',
        'user_id',
        'document_status_id',
        'department_id',
    ];
}
