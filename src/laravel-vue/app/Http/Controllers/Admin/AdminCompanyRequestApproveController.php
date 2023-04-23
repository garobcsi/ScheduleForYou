<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminAddCompanyApprovedTypeRequest;
use App\Models\CompanyRequestType;

class AdminCompanyRequestApproveController extends Controller
{
    public function getRequests() {
        //get types to chose from
    }

    public function getPendingRequests() {
        //get types to chose from
    }

    public function add(AdminAddCompanyApprovedTypeRequest $request) {
        // adds approved item
    }

    public function Approve(CompanyRequestType $type) {
        // approves request
    }

    public function Denies(CompanyRequestType $type) {

    }

    public function Rename(AdminAddCompanyApprovedTypeRequest $request,CompanyRequestType $type) {

    }
}
