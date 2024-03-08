<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use App\Http\Requests\CityRequest;
use App\Models\City;
use Illuminate\Http\Request;

class CityControllerCreate extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(CityRequest $request)
	{
		City::create($request->validated());
	}
}
