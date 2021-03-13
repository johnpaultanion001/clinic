<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FullDate extends Model
{
    public $table = 'full_dates';

    protected $fillable = [
        'fulldate',
    ];
}
