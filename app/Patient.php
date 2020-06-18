<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'last_name', 'first_name', 'middle_initial',
        'age', 'home_address', 'work_address', 'email',
        'landline_number', 'mobile_number',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function patientContactPerson(){
        $this->hasMany(PatientContactPerson::class);
    }

}
