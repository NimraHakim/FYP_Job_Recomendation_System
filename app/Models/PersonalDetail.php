<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalDetail extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'cnic',
        'fname',
        'phone',
        'landline',
        'gmail'
    ];
}
