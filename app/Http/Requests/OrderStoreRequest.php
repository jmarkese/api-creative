<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderStoreRequest extends FormRequest
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
            'ship_to_first_name' => 'required|string|min:1',
            'ship_to_last_name' => 'required|string|min:1',
            'ship_to_address_1' => 'required|string|min:1',
            'ship_to_address_2' => 'string',
            'ship_to_postal_code' => 'regex:/^\d{5}([ \-])?(\d{4})?$/i',
            'ship_to_city' => 'required|string|min:1',
            'ship_to_state' => 'required|alpha|size:2',
            'ship_to_country' => 'required|alpha|size:2',
            'bill_to_first_name' => 'required|string|min:1',
            'bill_to_last_name' => 'required|string|min:1',
            'bill_to_address_1' => 'required|string|min:1',
            'bill_to_address_2' => 'string',
            'bill_to_postal_code' => 'regex:/^\d{5}([ \-])?(\d{4})?$/i',
            'bill_to_city' => 'required|alpha_dash',
            'bill_to_state' => 'required|alpha|size:2',
            'bill_to_country' => 'required|alpha|size:2',
            'order_line_items.*.unit_price' => 'required|numeric',
            'order_line_items.*.tax' => 'required|numeric',
            'order_line_items.*.shipping' => 'required|numeric',
            'order_line_items.*.discount' => 'required|numeric',
            'order_line_items.*.total' => 'required|numeric',
            'order_line_items.*.qty' => 'required|numeric',
            'order_line_items.*.product_id' => 'required|exists:products,id',
            'order_line_items.*.vendor_id' => 'required|exists:vendors,id',
        ];
    }
}
