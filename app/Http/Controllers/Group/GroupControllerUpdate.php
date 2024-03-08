<?php

namespace App\Http\Controllers\Group;

use App\Http\Controllers\Controller;
use App\Http\Requests\GroupRequest;
use App\Models\Group;

class GroupControllerUpdate extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(GroupRequest $request)
	{
		Group::findOrFail($request->id)->update($request->validated());
	}
}
