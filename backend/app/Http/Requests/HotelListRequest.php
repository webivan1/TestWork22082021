<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelListRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'page' => 'integer|min:1',
            // @todo add another rules for sorting or searching
        ];
    }
}
