<?php

namespace App\Enums\Permissions;

enum UserPermission: string
{
    case CREATE_USER = 'create user';
    case EDIT_USER = 'edit user';
    case DELETE_USER = 'delete user';
    case VIEW_USERS = 'view users';
    case ALL_USER_PERMISSIONS = 'all user permissions';
    // Add more permissions as needed
}
