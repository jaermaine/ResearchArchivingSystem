<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faculty extends Model
{
    use HasFactory;

    protected $table = 'faculty'; // Ensure this is 'faculty' and not 'faculties'

    protected $fillable = [
        'first_name',
        'last_name',
        'user_id',
        'document_id',
        'department_id',
    ];

    public function department(): belongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function users(): belongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function document_student(): hasMany
    {
        return $this->hasMany(DocumentFaculty::class);
    }
}
