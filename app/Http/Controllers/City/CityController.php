<?php

namespace App\Http\Controllers\City;

use App\Http\Controllers\Controller;
use App\Models\City;
use Inertia\Inertia;

class CityController extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke()
	{
		return Inertia::render('City/City', ['cities' => City::orderBy('name')->get()]);
	}
}
