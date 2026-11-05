<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'country',
        'city',
        'state',
        'postal_code',
        'full_address'
    ];
}
