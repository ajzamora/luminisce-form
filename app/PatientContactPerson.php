<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientContactPerson extends Model
{
    protected $fillable = [
        'relationship',
    ];

    public function patient(){
        return $this->belongsTo('App\Patient');
    }

    public function contactPerson(){
        return $this->belongsTo('App\ContactPerson');
    }
}
