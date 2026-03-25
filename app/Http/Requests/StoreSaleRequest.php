<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSaleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'car_id' => 'required|exists:cars,id',
            'customer_id' => 'required|exists:customers,id',
            'sale_price' => 'required|numeric|min:0',
            'sale_date' => 'required|date',
        ];
    }
}
