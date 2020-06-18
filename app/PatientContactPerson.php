<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientContactPerson extends Model
{
    protected $fillable = [
        'relationship',
    ];

    public function patient(){
        $this->belongsTo(Patient::class);
    }

    public function contactPerson(){
        $this->belongsTo(ContactPerson::class);
    }
}
