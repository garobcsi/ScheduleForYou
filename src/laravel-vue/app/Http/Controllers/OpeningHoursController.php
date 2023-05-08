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
    public function update(OpeningHoursRequest $request, Company $company){
        $this->authorize('onlyOwnerCoOwnerManager',$company);
        $data = $request->validated();
        $companyOpeningHours = $company->OpeningHours;
        if (array_key_exists('monday_start',$data)) $companyOpeningHours->monday_start = $data["monday_start"];
        if (array_key_exists('monday_end',$data)) $companyOpeningHours->monday_end = $data["monday_end"];
        if (array_key_exists('tuesday_start',$data)) $companyOpeningHours->tuesday_start = $data["tuesday_start"];
        if (array_key_exists('tuesday_end',$data)) $companyOpeningHours->tuesday_end = $data["tuesday_end"];
        if (array_key_exists('wednesday_start',$data)) $companyOpeningHours->wednesday_start = $data["wednesday_start"];
        if (array_key_exists('wednesday_end',$data)) $companyOpeningHours->wednesday_end = $data["wednesday_end"];
        if (array_key_exists('thursday_start',$data)) $companyOpeningHours->thursday_start = $data["thursday_start"];
        if (array_key_exists('thursday_end',$data)) $companyOpeningHours->thursday_end = $data["thursday_end"];
        if (array_key_exists('friday_start',$data)) $companyOpeningHours->friday_start = $data["friday_start"];
        if (array_key_exists('friday_end',$data)) $companyOpeningHours->friday_end = $data["friday_end"];
        if (array_key_exists('saturday_start',$data)) $companyOpeningHours->saturday_start = $data["saturday_start"];
        if (array_key_exists('saturday_end',$data)) $companyOpeningHours->saturday_end = $data["saturday_end"];
        if (array_key_exists('sunday_start',$data)) $companyOpeningHours->sunday_start = $data["sunday_start"];
        if (array_key_exists('sunday_end',$data)) $companyOpeningHours->sunday_end = $data["sunday_end"];
        $companyOpeningHours->save();
        return response()->json(["message" => "Data updated successfully."],201);
    }
}
