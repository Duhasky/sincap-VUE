<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Permissions\{RoleController, RoleAbilityController, RoleAbilityCreateDelete, RoleControllerCreate, RoleControllerUpdate, RoleUserCreateDelete};
use App\Http\Controllers\Person\PersonControllerCreate;
use App\Http\Controllers\Person\PersonControllerManagement;
use App\Http\Controllers\Person\PersonControllerStore;
use App\Http\Controllers\Profile\{ ProfileControllerDestroy, ProfileControllerEdit, ProfileControllerUpdate };
use App\Http\Controllers\User\{UserControllerCreate, UserControllerUpdate, UserControllerActive, UserControllerDelete, UserControllerManagement, UserControllerRegister, UserControllerEdit};
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home', ['user' => User::with('roles')->loged()] );
})->name('Home');

Route::get('/user/management', UserControllerManagement::class)->name('user.management')->middleware('can:user_read');
Route::post('/user/create', UserControllerCreate::class)->name('user.create')->middleware('can:user_create');
Route::get('/user/edit/{id}', UserControllerEdit::class)->name('user.edit')->middleware('can:user_update');
Route::put('/user/update/{id}', UserControllerUpdate::class)->name('user.update')->middleware('can:user_update');
Route::put('/user/edit/active/{id}', UserControllerActive::class)->name('user.active')->middleware('can:user_update');
Route::delete('/user/delete/{id}', UserControllerDelete::class)->name('user.delete')->middleware('can:user_delete');

Route::middleware('can:role_admin')->group(function () {
Route::get('/permissions/role', RoleController::class)->name('role.management');
Route::post('/permissions/role/create', RoleControllerCreate::class)->name('role.create');
Route::put('/permissions/role/update', RoleControllerUpdate::class)->name('role.update');
Route::get('/permissions/ability/{id}', RoleAbilityController::class)->name('role.ability');
Route::post('/permissions/{role_id}/{abilities}', RoleAbilityCreateDelete::class)->name('ability.create.delete');

Route::post('/role_user/{user_id}/{role_id}', RoleUserCreateDelete::class)->name('role.user.create.delete');
});

Route::get('/person', PersonControllerManagement::class)->name('person.management');
Route::get('/person/create', PersonControllerCreate::class)->name('person.create');
Route::post('/person/store', PersonControllerStore::class)->name('person.store');

Route::get('/dashboard', DashboardController::class)->name('dashboard');
Route::get('/profile', ProfileControllerEdit::class)->name('profile.edit');
Route::patch('/profile', ProfileControllerUpdate::class)->name('profile.update');
Route::delete('/profile', ProfileControllerDestroy::class)->name('profile.destroy');

Route::middleware('auth', 'verified')->group(function () {});

require __DIR__ . '/auth.php';
