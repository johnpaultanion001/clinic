<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purpose extends Model
{
    public $table = 'purposes';
    protected $fillable = [
        'name',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'purpose_id', 'id');
    }
}
