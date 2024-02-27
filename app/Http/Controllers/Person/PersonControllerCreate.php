<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Person;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PersonControllerCreate extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return Inertia::render('Person/PersonCreate', ['groups' => Group::all()]);
    }
}
