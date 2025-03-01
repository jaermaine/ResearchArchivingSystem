<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentType extends Model
{
    use HasFactory;
    
    protected $table = 'college';

    protected $fillable = [
        'name',
        'document_id'
    ];

    public function document(): belongsTo
    {
        return $this->belongsTo(Documents::class);
    }
}
