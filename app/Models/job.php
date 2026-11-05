<?php

namespace App\Models;
use App\Models\JobApplication;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class job extends Model
{
    use HasFactory;


    public function jobType(){
        return $this->belongsTo(jobType::class);
    }
    public function category(){
        return $this->belongsTo(category::class);
    }
    public function applications()
{
    return $this->hasMany(JobApplication::class,'job_id');
}
}
