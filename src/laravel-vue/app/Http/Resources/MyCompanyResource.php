<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MyCompanyResource extends JsonResource
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
            "id" => $this->id,
            "perm" =>$this->permissions->where('id',auth('sanctum')->user()->id)->first()->pivot->permission,
            "name" => $this->name,
            "introduce" => $this->introduce,
            "email" => $this->email,
            "tel" => $this->tel,
            "address" => $this->address,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at
        ];
    }
}
