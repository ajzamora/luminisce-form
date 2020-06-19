<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CosmeticForm extends Model
{
    protected $fillable = [
        'cquery01', 'cquery02', 'cquery03',
        'cquery04', 'cquery05', 'cquery06',
        'cquery07', 'cquery08', 'cquery09',
        'cquery10', 'cquery11', 'cquery12',
        'cquery13', 'cquery14', 'cquery15',
        'cquery16', 'cquery17', 'cquery18',
        'cquery19', 'cquery20', 'cquery21',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function patient(){
        return $this->belongsTo('App\Patient');
    }
}
