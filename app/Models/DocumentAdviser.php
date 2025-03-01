<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentAdviser extends Model
{
    protected $table = 'document_adviser';

    protected $fillable = [
        'document_id',
        'adviser_id',
    ];

    public function documents(): belongsTo
    {
        return $this->belongsTo(Documents::class);
    }

    public function adviser(): belongsTo
    {
        return $this->belongsTo(Adviser::class);
    }
}
