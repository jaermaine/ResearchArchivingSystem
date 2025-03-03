<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Admin extends Model
{
    protected $table = 'adviser';

    protected $fillable = [
        'first_name',
        'last_name',
        'user_id',
    ];

    public function users(): belongsTo
    {
        return $this->belongsTo(User::class);
    }
}