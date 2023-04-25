<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyType extends Model
{
    protected $table = "company_types";
    protected $fillable = ["company_id","type_id"];
    public $timestamps = false;
    protected $primaryKey = "type_id";
}
