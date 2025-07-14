<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AppliedJob extends Model
{
    protected $fillable = ['user_id', 'career_id', 'name', 'email', 'cv_path'];

    // public function career()
    // {
    //     return $this->belongsTo(Career::class, 'career_id' );
    // }

    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }
}
