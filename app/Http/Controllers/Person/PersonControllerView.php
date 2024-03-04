<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonControllerView extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        return Inertia::render('Person/PersonView', ['person' => Person::with('photos','group', 'city')->find($id)]);
    }
}
