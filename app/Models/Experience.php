<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
   protected $fillable = [

    'user_id',

    'field_name',

    'company_name',

    'years',

    'certificate',

];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}