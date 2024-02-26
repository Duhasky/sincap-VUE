<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Inertia\Inertia;

class RoleAbilityController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        return Inertia::render('Permissions/RoleAbility', ['role' => Role::with('abilities')->find($id)]);
    }
}
