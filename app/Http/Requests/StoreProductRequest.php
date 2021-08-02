<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2021-08-02 21:53:12
 * File: Product.php
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'code' => 'required|string|max:191',
            'name' => 'required|string|max:191',
            'image' => 'nullable|string|max:191',
            'description' => 'nullable|string',
            'stock_in' => 'nullable|numeric',
            'stock_out' => 'nullable|numeric',
            'inventory' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'discount' => 'nullable|numeric',
            'status' => 'nullable|boolean',
            //{{REQUEST_RULES_NOT_DELETE_THIS_LINE}}
        ];
    }
}
