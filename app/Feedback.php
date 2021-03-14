<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    public $table = 'feedback';

    protected $fillable = [
        'name',
        'email',
        'number',
        'msg',
    ];
}
