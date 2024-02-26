<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use Inertia\Inertia;

class PersonControllerManagement extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        return Inertia::render('Person/PersonManagement');
    }
}
