<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;

class CityControllerUpdate extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(CityRequest $request)
	{
		City::findOrFail($request->id)->update($request->validated());
	}
}
