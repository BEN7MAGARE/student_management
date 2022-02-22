<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $fillable = ['code', 'course_id', 'mode', 'start_date', 'end_date'];

    public function validate($request)
    {
        return $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'mode' => ['required','max:40'],
            'start_date' => ['required', 'max:30'],
        ]);
    }

    public function generateCode($course_id,$mode,$start_date)
    {
        $course = Course::where('id',$course_id)->first();
        $year = date('Y',strtotime($start_date));
        if ($mode === "part-time") {
            return $course->code."/".$year."/P";
        }elseif ($mode === "online") {
            return $course->code."/".$year."/E";
        }else {
            return $course->code."/".$year;
        }
    }


    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    
    public function applications()
    {
        return $this->hasMany(Application::class, 'class_id', 'id');
    }

}