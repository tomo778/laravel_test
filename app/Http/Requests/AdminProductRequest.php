<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AdminProductRequest extends FormRequest
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
        $errors = [
            'title'  => 'required',
            'text' => 'required',
            'category'  => 'required',
            'price'  => ['required', 'integer'],
            'num' => ['required', 'integer'],
            'file_data' => [
                'required',
                'mimes:jpeg,bmp,png',
                'dimensions:min_width=100,min_height=200'
            ],
        ];
        if (!empty($this->file_name) && empty($this->file_data)) {
            unset($errors['file_data']);
        }
        return $errors;
    }

    protected function failedValidation(Validator $validator)
    {
        $res = response()->json(['success' => false, 'errors' => $validator->getMessageBag()->toArray()], 200);
        throw new HttpResponseException($res);
    }

    // public function withValidator(Validator $validator)
    // {
    //     $validator->after(function ($validator) {
    //         if ($this->input('name') === 'terminator') {
    //             $validator->errors()->add('name', 'ログインできません');
    //         }
    //     });
    // }
}
