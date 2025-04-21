<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventSched extends Model
{
    use HasFactory;

    protected $table = 'schedevent';

    protected $fillable = [
        'eventname',
        'start',
        'end',
        'officeID',
    ];

    public $timestamps = false;
}
