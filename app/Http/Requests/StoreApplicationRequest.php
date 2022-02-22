<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
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
        ];
    }
}
