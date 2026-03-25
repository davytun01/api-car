<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInquiryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'car_id' => 'required|exists:cars,id',
            'message' => 'required|string',
            'status' => 'nullable|in:pending,contacted,closed',
        ];
    }
}
