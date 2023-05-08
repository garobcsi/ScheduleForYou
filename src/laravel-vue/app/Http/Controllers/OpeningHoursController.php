<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpeningHoursRequest;
use App\Models\Company;
use App\Models\CompanyOpeningHours;
use Illuminate\Http\Request;

class OpeningHoursController extends Controller
{
    public function index(){
        return response()->json(["data" => CompanyOpeningHours::all()],200);
    }
    public function show(CompanyOpeningHours $openingHours){
        return response()->json(["data" => $openingHours]);
    }
}
