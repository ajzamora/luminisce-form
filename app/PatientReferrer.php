<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientReferrer extends Model
{
    protected $fillable = [
        'relationship',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
