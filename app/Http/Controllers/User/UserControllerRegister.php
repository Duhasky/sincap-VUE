<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserControllerRegister extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
      return Inertia::render('Auth/Register');
    }
}
