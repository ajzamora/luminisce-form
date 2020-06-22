<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContactPerson extends Model
{
    protected $fillable = [
        'full_name',
        'home_address',
        'contact_number',
        'relationship',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function patient(){
        return $this->belongsTo('App\Patient');
    }
}
