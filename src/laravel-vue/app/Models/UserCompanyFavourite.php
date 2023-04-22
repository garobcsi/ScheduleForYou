<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCompanyFavourite extends Model
{
    protected $fillable = ["user_id","company_id"];
    protected $table = "user_company_favourite";
    public $timestamps = false;
    protected $primaryKey = "company_id";
}
