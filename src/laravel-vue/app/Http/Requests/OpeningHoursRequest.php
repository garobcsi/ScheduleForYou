<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OpeningHoursRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'monday_start' => ['nullable','date'],
            'monday_end' => ['nullable','date'],
            'tuesday_start' => ['nullable','date'],
            'tuesday_end' => ['nullable','date'],
            'wednesday_start' => ['nullable','date'],
            'wednesday_end' => ['nullable','date'],
            'thursday_start' => ['nullable','date'],
            'thursday_end' => ['nullable','date'],
            'friday_start' => ['nullable','date'],
            'friday_end' => ['nullable','date'],
            'saturday_start' => ['nullable','date'],
            'saturday_end' => ['nullable','date'],
            'sunday_start' => ['nullable','date'],
            'sunday_end' => ['nullable','date'],
        ];
    }
}
