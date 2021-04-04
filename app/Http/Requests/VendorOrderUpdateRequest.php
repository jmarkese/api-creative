<?php

namespace App\Http\Requests;

use App\Models\OrderLineItem;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VendorOrderUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @param Request $request
     * @return bool
     */
    public function authorize(Request $request)
    {
        $vendor = auth()->user()->vendor()->first();
        if (is_null($vendor)) {
            throw new HttpResponseException(response()->json([
                'errors' => 'Forbidden.'
            ], Response::HTTP_FORBIDDEN));
        }
        $ids = data_get($request->all('order_line_items'), '*.*.id');
        $orderLineItems = OrderLineItem::where('vendor_id', '!=', $vendor->id)->find($ids);
        if ($orderLineItems->count()) {
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
            'order_line_items' => 'required|array',
            'order_line_items.*.id' => 'required|exists:order_line_items,id',
            'order_line_items.*.flag_is_shipped' => 'required|boolean',
            'order_line_items.*.tracking_number' => 'string',
            'order_line_items.*.shipping_agent' => 'string',
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
