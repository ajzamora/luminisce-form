<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Referrer extends Model
{
    protected $fillable = [
        'full_name',
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
