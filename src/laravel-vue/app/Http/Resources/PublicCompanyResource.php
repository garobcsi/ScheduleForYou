<?php

namespace App\Http\Resources;

use App\Models\CompanyApprovedType;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicCompanyResource extends JsonResource
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
            "name" => $this->name,
            "type" => CompanyApprovedType::whereRelation('CompanyTypes','company_id',$this->id)->get()->count() !== 0 ? CompanyApprovedType::whereRelation('CompanyTypes','company_id',$this->id)->get() : null,
            "introduce" => $this->introduce,
            "email" => $this->email,
            "tel" => $this->tel,
            "address" => $this->address
        ];
    }
}
