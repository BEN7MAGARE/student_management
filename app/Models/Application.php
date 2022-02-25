<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','class_id','first_name','surname','last_name','email','phone','alt_phone','next_of_kin_name','next_of_kin_email','next_of_kin_phone','address','county','constituency','location','sublocation','village','kcse_year','kcse_index_no','kcse_mean_grade','kcse_certificate','kcpe_year','kcpe_index_no','kcpe_mean_grade','kcpe_certificate','class_id','status'];

    public function validate($request)
    {
        return $request->validate([
            'first_name' => ['required','string','max:60'],
            'surname' => ['required','string','max:60'],
            'last_name' => ['required','string','max:60'],
            'email' => ['required','string','max:60'],
            'phone' => ['required','string','max:60'],
            'alt_phone' => ['required','string','max:60'],
            'next_of_kin_name' => ['required','string','max:60'],
            'next_of_kin_email' => ['required','string','max:60'],
            'next_of_kin_phone' => ['required','string','max:16'],
            'address' => ['required','string','max:60'],
            'county' => ['required','string','max:60'],
            'constituency' => ['required','string','max:60'],
            'location' => ['required','string','max:60'],
            'sublocation' => ['required','string','max:60'],
            'village' => ['required','string','max:60'],
            'kcse_year' => ['required','string','max:60'],
            'kcse_index_no' => ['required','string','max:60'],
            'kcse_mean_grade' => ['required','string','max:60'],
            'kcse_certificate' => ['required','file','max:2048','mimes:jpg,JPG,png,PNG,pdf,.jfif'],
            'kcpe_year' => ['required','string','max:60'],
            'kcpe_index_no' => ['required','string','max:60'],
            'kcpe_mean_grade' => ['required','string','max:60'],
            'kcpe_certificate' => ['required','file','max:2048','mimes:jpg,JPG,PNG,png,pdf,jfif'],
            'class_id' => ['required','exists:classes,id'],
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function classe()
    {
        return $this->belongsTo(Classes::class, 'classs_id');
    }
    
}
