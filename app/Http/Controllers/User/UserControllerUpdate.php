<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateUpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserControllerUpdate extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UserCreateUpdateRequest $request)
    {
        User::findOrFail($request->id)->update($request->validated());

        return redirect()->route('user.management');
    }
}
