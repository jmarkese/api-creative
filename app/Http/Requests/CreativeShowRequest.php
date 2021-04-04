<?php

namespace App\Http\Requests;

use App\Models\Creative;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreativeShowRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @param Request $request
     * @return bool
     */
    public function authorize(Request $request)
    {
        $userId = auth()->user()->id;
        $id = $request->route('creative');
        if (0 == Creative::where(['user_id' => $userId, 'id' => $id])->count()) {
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
            //
        ];
    }
}
