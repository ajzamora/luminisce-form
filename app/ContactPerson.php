<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    protected $fillable = [
        'full_name',
        'home_address',
        'contact_number',
    ];

    public function patientContactPeople(){
        return $this->hasMany('App\PatientContactPerson');
    }

    public function patients(){
        return $this->hasManyThrough('App\Patient', 'App\PatientContactPerson');
    }
}
