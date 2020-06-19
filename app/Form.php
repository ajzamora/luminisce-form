<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = [
        'query01', 'query02', 'query03',
        'query04', 'query05', 'query06',
        'query07', 'query08', 'query09',
        'query10', 'query11', 'query12',
        'query13', 'query14', 'query15',
        'query16', 'query17', 'query18',
        'query19_1', 'query19_2', 'query19_3',
        'query19_5', 'query19_4', 'query19_6',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
