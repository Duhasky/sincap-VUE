<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;

class RoleUserCreateDelete extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($user_id, $role_id)
    {
        User::with('roles')->find($user_id)->roles()->toggle($role_id);
    }
}
