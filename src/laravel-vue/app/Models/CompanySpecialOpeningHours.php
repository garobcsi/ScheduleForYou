<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySpecialOpeningHours extends Model
{
    protected $table = "company_special_opening_hours";
    public $timestamps = false;
    protected $fillable = ['companies_id','start','end','open_or_close'];

    public function CompanyOpeningHours(){
        return $this->belongsTo(CompanyOpeningHours::class,'opening_hours_id','id');
    }
}
