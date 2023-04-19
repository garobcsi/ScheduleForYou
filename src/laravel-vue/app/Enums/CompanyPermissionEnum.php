<?php

namespace App\Enums;

enum CompanyPermissionEnum:string
{
    case Owner = "owner";
    case CoOwner = "coowner";
    case Manager = "manager";
    case ReadOnly = "read";
    case Write = "write";

}
