<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','class_id','first_name','surname','last_name','email','phone','alt_phone','next_of_kin_name','next_of_kin_email','next_of_kin_phone','address','county','constituency','location','sublocation','village','kcse_year','kcse_index_no','kcse_mean_grade','kcse_certificate','kcpe_year','kcpe_index_no','kcpe_mean_grade','kcpe_certificate','class_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'classs_id');
    }
    
}
