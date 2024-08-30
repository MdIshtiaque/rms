<?php

namespace App\Enums\Permissions;

enum UserPermission: string
{
    case CREATE_USER = 'create user';
    case EDIT_USER = 'edit user';
    case DELETE_USER = 'delete user';
    case VIEW_USERS = 'view users';
    // Add more permissions as needed
}
