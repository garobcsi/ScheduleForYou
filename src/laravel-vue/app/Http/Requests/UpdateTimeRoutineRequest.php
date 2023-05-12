<?php

namespace App\Http\Requests;

use App\Enums\RepeatTimeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTimeRoutineRequest extends FormRequest
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
            "group_id" => ["nullable","exists:user_time_groups,id"],
            "name" => ["nullable","max:100"],
            "start" => ["nullable","date"],
            "end" => ["nullable","date"],
            "repeat_time" => ["nullable",Rule::in(array_column(RepeatTimeEnum::cases(), 'value'))],
            "description" => ["nullable"],
            "allDay" => ["nullable","boolean"]
        ];
    }
}
