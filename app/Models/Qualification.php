<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Qualification extends Model
{
    use HasFactory;

    protected $fillable = ['course_id','mean_grade','qualifications'];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
