<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Documents extends Model
{
    protected $table = 'documents'; // Ensure this is 'faculty' and not 'faculties'

    protected $fillable = [
        'title',
        'abstract',
        'field_topic',
        'document_status_id',
    ];

    public function department(): belongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function documentStatus(): belongsTo
    {
        return $this->belongsTo(DocumentStatus::class);
    }

    public function documentStudent(): hasMany
    {
        return $this->hasMany(DocumentStudent::class);
    }

    public function documentFaculty(): hasMany
    {
        return $this->hasMany(DocumentFaculty::class);
    }
}
