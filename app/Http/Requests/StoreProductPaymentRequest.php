<?php

/**
 * Created by: Tanmnt
 * Email: maingocthanhtan96@gmail.com
 * Date Time: 2021-08-02 21:58:19
 * File: ProductPayment.php
 */

namespace App\Http\Requests;

use App\Models\ProductDetail;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductPaymentRequest extends FormRequest
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
            'total' => [
                'nullable',
                'numeric',
                function ($attribute, $value, $fail) {
                    $productDetail = ProductDetail::productDetail($this->request);
                    if ($productDetail && $productDetail->amount < $value) {
                        $fail(trans('validation.max.numeric', ['max' => $productDetail->amount]));
                    }
                },
            ],
            'note' => 'nullable|string',
            //{{REQUEST_RULES_NOT_DELETE_THIS_LINE}}
        ];
    }
}
