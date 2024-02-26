<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserControllerActive extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $user = User::find($id);
        $user->is_active = !$user->is_active;
        $user->save();
    }
}
