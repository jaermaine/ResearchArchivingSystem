<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DocumentFaculty extends Model
{
    protected $table = 'document_faculty'; // Ensure this is 'faculty' and not 'faculties'

    protected $fillable = [
        'document_id',
        'faculty_id',
    ];

}
