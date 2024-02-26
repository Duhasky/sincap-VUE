<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Ability;
use App\Models\Role;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = \App\Models\User::create([
          'name' => 'admin',
          'email' => 'admin@admin.com',
          'password' => Hash::make('admin'),
          'remember_token' => Str::random(10),
        ]);

        $role = $user->roles()->create(['name' => 'admin']);
        $role->abilities()->create([ 'name' => 'user_create' ]);
        $role->abilities()->create([ 'name' => 'user_read' ]);
        $role->abilities()->create([ 'name' => 'user_update' ]);
        $role->abilities()->create([ 'name' => 'user_delete' ]);
        
        $role->abilities()->create([ 'name' => 'role_admin' ]);
        
        \App\Models\User::factory(100)->create();
    }
}
