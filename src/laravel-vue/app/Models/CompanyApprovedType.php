<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyApprovedType extends Model
{
    public $timestamps = false;
    protected $fillable = ["name","lang"];
    protected $table = "company_approved_types";

    public function CompanyTypes() {
        return $this->hasMany(CompanyType::class,'type_id','id');
    }
}
