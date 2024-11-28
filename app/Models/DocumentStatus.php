<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentStatus extends Model
{
    use HasFactory;
    
    protected $table = 'document_statuses'; // Ensure this is 'faculty' and not 'faculties'

    protected $fillable = [
        'name'
    ];
}
