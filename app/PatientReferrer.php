<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientReferrer extends Model
{
    protected $fillable = [
        'relationship',
    ];
}
