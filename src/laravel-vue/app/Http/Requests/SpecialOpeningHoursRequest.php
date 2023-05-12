<?php

namespace App\Http\Requests;

use App\Enums\SpecialOpeningEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SpecialOpeningHoursRequest extends FormRequest
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
            'start' => ['required','date'],
            'end' => ['required','date'],
            'open_or_close' => [Rule::in(array_column(SpecialOpeningEnum::cases(), 'value')),'required'],
        ];
    }
}
