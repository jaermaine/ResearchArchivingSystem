<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Program extends Model
{
    use HasFactory;
    
    protected $table = 'program';

    protected $fillable = [
        'name',
        'abbreviation',
        'college_id'
    ];

    public function student(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function document(): HasMany
    {
        return $this->hasMany(Documents::class);
    }

    public function year(): HasMany
    {
        return $this->hasMany(Year::class);
    }

    public function section(): HasMany
    {
        return $this->hasMany(Section::class);
    }
    public function college(): BelongsTo
    {
        return $this->belongsTo(College::class, 'college_id', 'id'); 
    }
}
