<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Inertia\Inertia;

class PersonControllerManagement extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return Inertia::render('Person/PersonManagement', [ 'persons' => Person::with('photos')->with('group')->get() ]);
    }
}
