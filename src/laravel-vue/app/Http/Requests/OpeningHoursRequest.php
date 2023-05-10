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
            'monday_start' => ['nullable','date_format:H:i'],
            'monday_end' => ['nullable','date_format:H:i'],
            'tuesday_start' => ['nullable','date_format:H:i'],
            'tuesday_end' => ['nullable','date_format:H:i'],
            'wednesday_start' => ['nullable','date_format:H:i'],
            'wednesday_end' => ['nullable','date_format:H:i'],
            'thursday_start' => ['nullable','date_format:H:i'],
            'thursday_end' => ['nullable','date_format:H:i'],
            'friday_start' => ['nullable','date_format:H:i'],
            'friday_end' => ['nullable','date_format:H:i'],
            'saturday_start' => ['nullable','date_format:H:i'],
            'saturday_end' => ['nullable','date_format:H:i'],
            'sunday_start' => ['nullable','date_format:H:i'],
            'sunday_end' => ['nullable','date_format:H:i'],
        ];
    }
}
