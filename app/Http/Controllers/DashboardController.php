<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Group;
use App\Models\Person;
use App\Models\User;
use Inertia\Inertia;

class DashboardController extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke()
	{
		return Inertia::render(
			'Dashboard',
			[
				'groups' => Group::get()->count(),
				'cities' => City::get()->count(),
				'persons' => Person::get()->count(),
				'users' => User::get()->count(),
			]
		);
	}
}
