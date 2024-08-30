<?php

namespace App\Enums\Permissions;

use App\Traits\UseEnum;

enum RolePermissionEnums: string
{
    use UseEnum;

    case CREATE_ROLE = 'create_role';
    case UPDATE_ROLE = 'update_role';
    case DELETE_ROLE = 'delete_role';
    case VIEW_ROLE = 'view_role';
    case ASSIGN_ROLE = 'assign_role';
}
