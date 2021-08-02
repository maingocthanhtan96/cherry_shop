<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2021-08-02 22:00:29
 * File: ProductReject.php
 */

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRejectRequest extends FormRequest
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
            'total' => 'nullable|numeric',
            'price' => 'nullable|numeric',
            'note' => 'nullable|string',
            //{{REQUEST_RULES_NOT_DELETE_THIS_LINE}}
        ];
    }
}
