<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowed extends Model
{
    use HasFactory;

    protected $table = 'borrowequip';

    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'equipid',
        'equiptype',
        'equipqty',
        'borrowerid',
        'department',
        'borrowertype',
        'dateborrowed',
        'dateretured',
        'borrowedspan',
        'stat'
    ];
}
