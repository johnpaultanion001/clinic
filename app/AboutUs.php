<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutUs extends Model
{
    public $table = 'about_us';

    protected $fillable = [
        'title',
        'body',
    ];
}
