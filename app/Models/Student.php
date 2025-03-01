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
        'user_id',
        'document_id',
        'college_id',
        'program_id',
        'year_level_id',
        'section_id'
    ];

    public function college(): belongsTo
    {
        return $this->belongsTo(College::class);
    }

    public function program(): belongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function year(): belongsTo
    {
        return $this->belongsTo(Year::class);
    }

    public function section(): belongsTo
    {
        return $this->belongsTo(Section::class);
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
