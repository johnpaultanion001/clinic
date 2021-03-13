<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    public $table = 'holidays';

    protected $dates = [
        'date_holiday',
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'name',
        'date_holiday',
    ];
    
}
