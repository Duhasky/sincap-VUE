<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateUpdateRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserControllerCreate extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UserCreateUpdateRequest $request)
    {
        User::create($request->validated());
    }
}
