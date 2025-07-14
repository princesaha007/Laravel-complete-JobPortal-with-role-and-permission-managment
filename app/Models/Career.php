<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $fillable = [
        'job_category',
        'job_title',
        'job_description',
        'key_responsibilities',
        'qualifications',
        'salary_range',
        'location',
        'created_by',
    ];

    public function appliedJobs()
    {
        return $this->hasMany(AppliedJob::class , 'career_id');
    }

    public function applicants()
    {
        return $this->belongsToMany(User::class, 'applied_jobs', 'career_id', 'user_id')
                    ->withPivot('name', 'email', 'cv_path')
                    ->withTimestamps();
    }



}
