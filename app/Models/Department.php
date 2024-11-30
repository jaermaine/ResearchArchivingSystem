<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Student;
use App\Models\Faculty;
use App\Models\Documents;

class Department extends Model
{
    use HasFactory;
    
    protected $table = 'departments'; // Ensure this is 'faculty' and not 'faculties'

    protected $fillable = [
        'name'
    ];

    public function student(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function faculty(): HasMany
    {
        return $this->hasMany(Faculty::class);
    }

    public function document(): HasMany
    {
        return $this->hasMany(Documents::class);
    }
}
