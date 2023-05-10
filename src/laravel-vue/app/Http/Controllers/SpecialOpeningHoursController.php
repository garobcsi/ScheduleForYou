<?php

namespace App\Http\Controllers;

use App\Http\Requests\SpecialOpeningHoursRequest;
use App\Models\Company;
use App\Models\CompanySpecialOpeningHours;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SpecialOpeningHoursController extends Controller
{
    public function index(Company $company): JsonResponse
    {
        return response()->json(["data" => CompanySpecialOpeningHours::whereRelation('CompanyOpeningHours','companies_id',$company->id)],200);
    }
    public function show(CompanySpecialOpeningHours $id): JsonResponse
    {
        return response()->json(["data" => $id],200);
    }
    public function update(SpecialOpeningHoursRequest $request, Company $company, CompanySpecialOpeningHours $SpecialOH): JsonResponse
    {
        $this->authorize('onlyOwnerCoOwnerManager',$company);
        $data = $request->validated();
        $SpecialOH->start = $data["start"];
        $SpecialOH->end = $data["end"];
        $SpecialOH->open_or_close = $data["open_or_close"];
        $data->save();
        return response()->json(["message" => "Data updated successfully."],201);
    }
    public function destroy(Company $company, CompanySpecialOpeningHours $SpecialOHID): JsonResponse
    {
        $this->authorize('onlyOwnerCoOwner',$company);
        dd($company->OpeningHours->CompanySpecialOpeningHours);
        $SpecialOHID->delete();
        return response()->json(["message" => "Deleted successfully."],200);
    }
}
