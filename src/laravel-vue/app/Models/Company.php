<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = "companies";
    public $timestamps = true;
    protected $fillable = ["name","introduce","email","tel","address"];

    public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class,'company_permissions')->withPivot('permission');
    }

    public function CompanyFavourite() {
        return $this->hasMany(UserCompanyFavourite::class,'company_id','id');
    }

}
