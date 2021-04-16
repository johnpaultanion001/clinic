<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Database extends Model
{
    public $table = 'databases';

    protected $fillable = [
        'name',
    ];
}
