<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use App\Models\Role;

class RoleAbilityCreateDelete extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id, $ability)
    {
        Role::with('abilities')->find($id)->abilities()->toggle($ability);
    }
}
