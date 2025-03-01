<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class College extends Model
{
    use HasFactory;
    
    protected $table = 'college';

    protected $fillable = [
        'name'
    ];

    public function student(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function adviser(): HasMany
    {
        return $this->hasMany(Adviser::class);
    }

    public function document(): HasMany
    {
        return $this->hasMany(Documents::class);
    }

    public function program(): HasMany
    {
        return $this->hasMany(Program::class);
    }
}
