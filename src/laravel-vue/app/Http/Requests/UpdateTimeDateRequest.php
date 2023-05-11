<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTimeDateRequest extends FormRequest
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
            "description" => ["nullable"],
            "allDay" => ["nullable","boolean"]
        ];
    }
}
