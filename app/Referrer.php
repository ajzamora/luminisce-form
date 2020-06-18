<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referrer extends Model
{
    protected $fillable = [
        'full_name',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
