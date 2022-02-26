<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deferment extends Model
{
    use HasFactory;

    public function validate($request)
    {
        return $request->validate([
            'academic_year' => ['required'],
            'year' => ['required'],
            'semester' => ['required'],
            'start_date' => ['required'],
            'period' => ['required'],
            'reason' => ['required','max:255'],
        ]);
    }

    protected $fillable = ['user_id','academic_year','year','semester','start_date','period','reason','status'];

   
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
