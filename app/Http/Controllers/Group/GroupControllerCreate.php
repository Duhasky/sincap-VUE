<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Group;

class GroupControllerCreate extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(GroupRequest $request)
	{
		Group::create($request->validated());
	}
}
