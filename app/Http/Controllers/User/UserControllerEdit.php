<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Inertia\Inertia;

class UserControllerEdit extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
      $user = User::with('roles')->findOrFail($id);
      return Inertia::render('User/EditUser', ['user' => $user, 'roles' => Role::all()]);
    }
}
