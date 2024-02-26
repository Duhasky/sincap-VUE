<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserControllerManagement extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $users = User::query()
            ->when($request->input('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->loged()
            ->with('roles')
            ->orderBy('id')
            ->paginate()
            ->withQueryString()
            ->through(fn ($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'is_active' => $user->is_active,
                'created_at' => $user->created_at,
                'roles' => $user->roles,
            ]);

        return Inertia::render('UserManagement', ['users' => $users, 'filters' => $request->only(['search'])]);
    }
}
