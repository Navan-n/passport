<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTagRequrst extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {

        return [
            'slug' => 'required|unique:mag_tags,slug,'.$this->id,
            'title' => 'required',
            'meta_desc' => 'required',
            'body' => 'required'
        ];
    }
    public function attributes(): array
    {
        return [
            'slug' => 'آدرس کوتاه',
            'title'=> 'عنوان',
            'meta_desc'=>'توضیحات متا',
            'body'=>'توضیحات'

        ];
    }
    public function messages(): array
    {
        return [
            'required' => ':attribute الزامی است',
            'unique' => ':attribute نباید تکراری باشد',
        ];
    }
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'error' => $validator->errors()/*->first()*/
        ]));
    }
    public function failedAuthorization()
    {
       dd('failedAuthorization');
    }
}
