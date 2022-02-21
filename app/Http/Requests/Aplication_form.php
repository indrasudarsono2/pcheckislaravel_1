<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Aplication_form extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $today = date('d-m-Y');
        $x = date('d-m-Y', strtotime('+30days', strtotime($today)));

        return [
            'activity_id' => 'required',
            'examination' => 'required',
            'remark' => 'required',
            'ats_name' => 'required',
            'address' => 'required',
            'rating_id' => 'required',

            'name' => 'required',
            'user_id' => 'required',
            'date_of_birth' => 'required',
            'place_of_birth' => 'required',
            'address_user' => 'required',
            'nationality' => 'required',
            'english_confirm' => 'required',
            'height' => 'required',
            'weight' => 'required',
            'hair' => 'required',
            'eyes' => 'required',
            'gender_id' => 'required',

            'rating_confirm' => 'required',
            'rating_confirm2' => 'required',
            'location' => 'required',
            'rating_id2' => 'required',

            'medex_confirm' => 'required',
            'medex_date' => 'required',
            'examiner' => 'required',
            'medexExpired' => 'required|date|after_or_equal:' . $x,

            'ielp_confirm' => 'required',
            'rater' => 'required',
            'institution' => 'required',
            'ielp_date' => 'required',
            'levell' => 'required',
            'ielpExpired' => 'required|date|after_or_equal:' . $x,

            'drugs_confirm' => 'required',

            'formal_education_id' => 'required',
            'year' => 'required',

            'sertificate_id' => 'required',
            'sertificate_institution' => 'required',
            'sertificate_released' => 'required',

            'failed_confirm' => 'required'
        ];
    }
}
