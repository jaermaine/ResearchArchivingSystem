<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    use HasFactory;

    protected $table = 'student';

    protected $fillable = [
        'first_name',
        'last_name',
        'suffix',
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
        return $this->hasMany(DocumentStudent::class);
    }
}
