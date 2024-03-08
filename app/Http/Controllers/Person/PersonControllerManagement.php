<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;
use Inertia\Inertia;

class PersonControllerManagement extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(Request $request)
	{
		$person = Person::query()
		->when($request->input('search'), function ($query, $search) {
			$query->where('name', 'like', "%{$search}%")
			->orWhere('surname', 'like', "%{$search}%");
		})
		->with('photos', 'group')
		->paginate()
		->withQueryString();

		return Inertia::render('Person/PersonManagement', ['persons' => $person, 'filters' => $request->only(['search'])]);
	}
}
