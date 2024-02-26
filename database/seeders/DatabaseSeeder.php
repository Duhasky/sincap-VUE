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

        \App\Models\Group::create(['name' => 'CV']);
        \App\Models\Group::create(['name' => 'GDE']);
        \App\Models\Group::create(['name' => 'PCC']);
        
        \App\Models\User::factory(100)->create();
        
        for ($i = 0; $i < 100; $i++) {
          $person = \App\Models\Person::factory()->create();

          // Crie 3 fotos para cada pessoa com diferentes tamanhos
          $photoSizes = [200, 300, 400];
          
          foreach ($photoSizes as $size) {
              $person->photos()->create(['photo' => "https://picsum.photos/{$size}"]);
          }
      }
    }
}
