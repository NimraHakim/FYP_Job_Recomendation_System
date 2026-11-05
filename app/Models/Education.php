<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{

 protected $table = 'educations';

    protected $fillable = [
        'user_id',
        'degree_level',
        'school',
        'board',
        'total_marks',
        'obtained_marks',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}