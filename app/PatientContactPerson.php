<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PatientContactPerson extends Model
{
    protected $fillable = [
        'relationship',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function patient(){
        return $this->belongsTo('App\Patient');
    }

    public function contactPerson(){
        return $this->belongsTo('App\ContactPerson');
    }
}
