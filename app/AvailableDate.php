<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class AvailableDate extends Model
{
    use SoftDeletes;

    public $table = 'available_dates';

    protected $dates = [
        'date_scheduled',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'date_scheduled',
        'available_slots',
        'max_slots',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function getStartTimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d', $value)->format(config('panel.date_format')) : null;
    }

    public function setStartTimeAttribute($value)
    {
        $this->attributes['date_scheduled'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }
}
