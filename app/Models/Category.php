<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'invtcategory';

    protected $fillable = [
        'serialnumber',
        'equipment',
        'typeequip',
        'number_equip',
    ];
}
