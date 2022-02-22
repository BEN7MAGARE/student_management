<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['code', 'name', 'years', 'semesters_per_year'];

    public function validate($request)
    {
        return $request->validate([
            'name' => ['required','string','max:100'],
            'years' => ['required','max:2'],
            'semesters_per_year' => ['required','max:2'],
            'mean_grade' => ['required','string','max:40'],
            'qualifications' => ['nullable','string','max:255']
        ]);
    }

    public function generateCode($name,$mode)
    {
        $names = explode(' ',$name);
        $code = "";
        foreach ($names as $key => $value) {
            if (strlen($value) > 3) {
                $code .= ucwords(substr($value,0,1));
            }
        }
        return $code;
    }

    public function classes()
    {
        return $this->hasMany(Classes::class, 'course_id', 'id');
    }

    public function qualification()
    {
        return $this->hasOne(Qualification::class, 'course_id', 'id');
    }

}