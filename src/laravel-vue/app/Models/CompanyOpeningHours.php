<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyOpeningHours extends Model
{
    public $timestamps = false;
    protected $table = "company_opening_hours";
    protected $fillable = ['monday_start','monday_end','tuesday_start','tuesday_end','wednesday_start','wednesday_end','thursday_start','thursday_end','friday_start','friday_end','saturday_start','saturday_end','sunday_start','sunday_end',];

    public function CompanySpecialOpeningHours(){
        return $this->hasMany(CompanySpecialOpeningHours::class, 'opening_hours_id', 'id');
    }
    public function Companies(){
        return $this->hasMany(Company::class,"id", "companies_id");
    }
}
