<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'brand' => 'sometimes|required|string|max:255',
            'model' => 'sometimes|required|string|max:255',
            'year' => 'sometimes|required|integer|min:1900|max:' . (date('Y') + 1),
            'price' => 'sometimes|required|numeric|min:0',
            'mileage' => 'sometimes|required|integer|min:0',
            'fuel_type' => 'sometimes|required|in:petrol,diesel,electric,hybrid',
            'transmission' => 'sometimes|required|in:automatic,manual',
            'color' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'status' => 'sometimes|nullable|in:available,reserved,sold',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }
}
