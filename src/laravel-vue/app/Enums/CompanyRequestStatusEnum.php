<?php

namespace App\Enums;

enum CompanyRequestStatusEnum:string
{
    case Pending = "pending";
    case Approved = "approved";
    case Denied = "denied";
    case Canceled = "canceled";
    case Renamed = "renamed";

}
