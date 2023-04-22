<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimeDateWithGroupsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "user_id" => $this->user_id,
            "name" => $this->name,
            "start" => $this->start,
            "end" => $this->end,
            "description" => $this->description,
            "group" => $this->group

        ];
    }
}
