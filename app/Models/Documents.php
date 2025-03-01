<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Documents extends Model
{
    protected $table = 'documents'; // Ensure this is 'faculty' and not 'faculties'

    protected $fillable = [
        'title',
        'abstract',
        'field_topic',
        'document_status_id',
    ];

    public function college(): belongsTo
    {
        return $this->belongsTo(College::class);
    }

    public function program(): belongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function document_status(): belongsTo
    {
        return $this->belongsTo(DocumentStatus::class);
    }

    public function document_student(): hasMany
    {
        return $this->hasMany(DocumentStudent::class);
    }

    public function document_adviser(): hasMany
    {
        return $this->hasMany(DocumentAdviser::class);
    }

    public function document_type(): hasOne
    {
        return $this->hasOne(DocumentType::class);
    }
}
