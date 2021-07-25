<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelFormRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:50',
            'city' => 'required|string|max:50',
            'address' => 'required|string|max:200',
            'description' => 'nullable|string',
            'stars' => 'nullable|integer|min:1|max:5',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'image' => [
                $this->hotel ? 'nullable' : 'required',
                'image',
                'mimes:jpg,png,jpeg,gif,svg,webp',
                'max:2048',
                'dimensions:min_width=100,min_height=100,max_width=1000,max_height=1000'
            ]
        ];
    }
}
