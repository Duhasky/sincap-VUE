<?php

namespace App\Http\Controllers\Permissions;

use App\Http\Controllers\Controller;
use App\Http\Requests\RoleRequest;
use App\Models\Role;

class RoleControllerUpdate extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(RoleRequest $request)
	{
		Role::findOrFail($request->id)->update($request->validated());
	}
}
