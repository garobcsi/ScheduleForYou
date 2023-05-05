<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySpecialOpeningHours extends Model
{
    protected $table = "company_special_opening_hours";
    public $timestamps = false;
    protected $fillable = ['start','end','open_or_close'];

    public function CompanyOpeningHours(){
        return $this->belongsToMany(CompanyOpeningHours::class,'id','opening_hours_id');
    }
}
