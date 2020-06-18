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

    public function patientContactPerson(){
        $this->hasMany(PatientContactPerson::class);
    }
}
