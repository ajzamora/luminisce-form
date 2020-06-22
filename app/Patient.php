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

    public function referrer(){
        return $this->hasOne('App\Referrer');
    }

    public function contactPerson() {
        return $this->hasOne('App\ContactPerson');
    }

    public function form() {
        return $this->hasOne('App\Form');
    }

    public function cosmeticForm() {
        return $this->hasOne('App\CosmeticForm');
    }

    public function transaction() {
        return $this->hasOne('App\Transaction');
    }
}
