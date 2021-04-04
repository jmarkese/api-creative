<?php

namespace App\Http\Requests;

use App\Models\Creative;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreativeUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(Request $request)
    {
        $userId = auth()->user()->id;
        $creative = $request->route('creative');
        if (0 == Creative::where(['user_id' => $userId, 'id' => $creative->id])->count()) {
            throw new HttpResponseException(response()->json([
                'errors' => 'Forbidden.'
            ], Response::HTTP_FORBIDDEN));
        }
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
            'slug' => 'required|alpha_dash',
            'name' => 'required|string',
            'description' => 'required|string',
            'image_url' => 'required|url',
            'products' => 'prohibited'
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
