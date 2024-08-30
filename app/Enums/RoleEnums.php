<?php

namespace App\Enums;

use App\Traits\UseEnum;

enum RoleEnums: string
{
    use UseEnum;

    case SUPER_ADMIN = "Super Admin";
    case ADMIN = "Admin";
    case FLAT_OWNER = "Flat Owner";
    case BACHELOR = "Bachelor";
}
