<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentStudent extends Model
{
    protected $table = 'document_student'; // Ensure this is 'faculty' and not 'faculties'

    protected $fillable = [
        'document_id',
        'student_id',
    ];

    public function documents(): belongsTo
    {
        return $this->belongsTo(Documents::class);
    }

    public function students(): belongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
