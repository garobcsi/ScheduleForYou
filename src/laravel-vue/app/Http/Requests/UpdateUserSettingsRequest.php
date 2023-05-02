<?php

namespace App\Http\Requests;

use App\Enums\LangEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserSettingsRequest extends FormRequest
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
            "lang" => ["nullable","max:10",Rule::in(array_column(LangEnum::cases(), 'value'))],
            "theme" => ["nullable","max:10",Rule::in(['light','dark'])],
        ];
    }
}
