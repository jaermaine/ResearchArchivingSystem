<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Section extends Model
{
    use HasFactory;
    
    protected $table = 'section';

    protected $fillable = [
        'name',
        'program_id',
        'year_id',
        'section_number'
    ];

    public function student(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function document(): HasMany
    {
        return $this->hasMany(Documents::class);
    }
}
