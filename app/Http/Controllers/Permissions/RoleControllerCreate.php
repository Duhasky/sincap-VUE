<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;

class RoleControllerCreate extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(RoleRequest $request)
	{
		Role::create($request->validated());
	}
}
