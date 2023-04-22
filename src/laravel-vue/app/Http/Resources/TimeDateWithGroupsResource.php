<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TimeDateWithGroupsResource extends JsonResource
{
    private function unsetw($data,$str) {
        unset($data[$str]);
        return $data;
    }

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
            "group" => $this->group !== null ? $this->unsetw($this->group,"user_id") : $this->group

        ];
    }
}
