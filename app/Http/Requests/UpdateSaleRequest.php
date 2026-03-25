<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSaleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sale_price' => 'sometimes|required|numeric|min:0',
            'sale_date' => 'sometimes|required|date',
        ];
    }
}
