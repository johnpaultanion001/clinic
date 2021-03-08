<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class Schedule extends Model
{
    use SoftDeletes;

    public $table = 'schedules';

    protected $dates = [
        'date_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'user_id',
        'purpose_id',
        'date_time',
        'time',
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
        $this->attributes['date_time'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
        //$this->attributes['time'] = $value ? Carbon::createFromFormat(config('panel.time_format'), $value)->format('H:i') : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function purpose()
    {
        return $this->belongsTo(Purpose::class, 'purpose_id');
    }
}
