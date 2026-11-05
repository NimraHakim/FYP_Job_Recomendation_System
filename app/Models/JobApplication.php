<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'user_id',
        'status'
    ];

    // Job Relation
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

    // Applicant Relation
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}