<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    public $table = 'announcements';

    protected $fillable = [
        'title',
        'body',
    ];

}
