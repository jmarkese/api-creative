<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreativeStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
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
            'slug' => 'required|unique:creatives|alpha_dash',
            'name' => 'required|string',
            'description' => 'required|string',
            'image_url' => 'required|url',
            'products' => 'required',
            'products.*.slug' => 'required|unique:products|alpha_dash',
            'products.*.custom_name' => 'required|string',
            'products.*.custom_description' => 'required|string',
            'products.*.sku' => 'required|unique:products|alpha_dash',
            'products.*.price' => 'required|numeric',
            'products.*.product_type_id' => 'required|exists:product_types,id',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  Validator  $validator
     *
     * @return void
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
