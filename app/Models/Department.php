<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    
    protected $table = 'departments'; // Ensure this is 'faculty' and not 'faculties'

    protected $fillable = [
        'name'
    ];
}
