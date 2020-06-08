<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class MypageAddressRequest extends FormRequest
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
            'zip1'  => 'required|digits:3',
            'zip2' => 'required|digits:4',
            'pref'  => 'required',
            'address1'  => 'required',
            'address2'  => 'required',
        ];
        // if (!empty($this->file_name) && empty($this->file_data)) {
        //     unset($errors['file_data']);
        // }
        // return $errors;
    }
}
