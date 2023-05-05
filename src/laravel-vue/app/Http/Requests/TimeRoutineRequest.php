<?php

namespace App\Http\Requests;

use App\Enums\RepeatTimeEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TimeRoutineRequest extends FormRequest
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
            "name" => ["required","max:100"],
            "start" => ["required","date"],
            "end" => ["required","date"],
            "repeat_time" => ["required",Rule::in(array_column(RepeatTimeEnum::cases(), 'value'))],
            "description" => ["nullable"]
        ];
    }
}
