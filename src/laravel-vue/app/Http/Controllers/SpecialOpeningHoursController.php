<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecialOpeningHoursRequest;
use App\Models\Company;
use App\Models\CompanySpecialOpeningHours;
use Illuminate\Http\Request;

class SpecialOpeningHoursController extends Controller
{
    public function index(){
        return response()->json(["data" => CompanySpecialOpeningHours::all()],200);
    }
    public function show(CompanySpecialOpeningHours $specialOH){
        return response()->json(["data" => $specialOH]);
    }
}
