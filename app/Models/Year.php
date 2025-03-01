<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Year extends Model
{
    use HasFactory;
    
    protected $table = 'year';

    protected $fillable = [
        'name',
        'program_id'
    ];

    public function section(): HasMany
    {
        return $this->hasMany(Section::class);
    }

    public function student(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function document(): HasMany
    {
        return $this->hasMany(Documents::class);
    }
}
