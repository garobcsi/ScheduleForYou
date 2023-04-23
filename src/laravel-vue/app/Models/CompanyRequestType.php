<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyRequestType extends Model
{
    public $timestamps = true;
    protected $fillable = ["company_id","requested_name","renamed_name","status"];
    protected $table = "company_request_type";
}
