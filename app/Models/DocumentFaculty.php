<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentFaculty extends Model
{
    protected $table = 'document_faculty'; // Ensure this is 'faculty' and not 'faculties'

    protected $fillable = [
        'document_id',
        'faculty_id',
    ];

    public function documents(): belongsTo
    {
        return $this->belongsTo(Documents::class);
    }

    public function students(): belongsTo
    {
        return $this->belongsTo(Faculty::class);
    }
}
