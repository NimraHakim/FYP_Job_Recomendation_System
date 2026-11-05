<?php

namespace App\Models;
use App\Models\Job;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class category extends Model
{
    use HasFactory;
    public function jobs()
{
    return $this->hasMany(Job::class, 'category_id');
}
    
}
