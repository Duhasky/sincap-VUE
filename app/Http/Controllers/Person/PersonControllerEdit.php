<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Group;
use App\Models\Person;
use Inertia\Inertia;

class PersonControllerEdit extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $person = Person::with('photos','group')->find($id);
        return Inertia::render('Person/PersonUpdate', ['person' => $person, 'groups' => Group::all(), 'cities' => City::all()]);
    }
}
