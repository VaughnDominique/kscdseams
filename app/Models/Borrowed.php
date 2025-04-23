<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowed extends Model
{
    use HasFactory;
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'borrowequip';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname',
        'mname',
        'lname',
        'equipid',
        'equiptype',
        'equipqty',
        'department',
        'borrowertype',
        'dateborrowed',
        'dateretured',
        'borrowedspan',
        'borrowerid',
        'stat',
        'mail_stat',
        'email',
    ];
}
