<?php

use App\Http\Controllers\City\{CityControllerCreate,CityController, CityControllerUpdate};
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Group\{GroupControllerCreate,GroupControllerUpdate,GroupController};
use App\Http\Controllers\Permissions\{ RoleController, RoleAbilityController, RoleAbilityCreateDelete, RoleControllerCreate, RoleControllerUpdate, RoleUserCreateDelete};
use App\Http\Controllers\Person\{PersonControllerCreate, PersonControllerDelete, PersonControllerEdit, PersonControllerManagement,PersonControllerStore, PersonControllerUpdate, PersonControllerView};
use App\Http\Controllers\Photo\PersonPhotoControllerDelete;
use App\Http\Controllers\Profile\{ ProfileControllerDestroy, ProfileControllerEdit, ProfileControllerUpdate };
use App\Http\Controllers\User\{UserControllerCreate, UserControllerUpdate, UserControllerActive, UserControllerDelete, UserControllerManagement, UserControllerEdit};
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
	return Inertia::render('Home');
})->name('home');

Route::get('/user/management', UserControllerManagement::class)->name('user.management')->middleware('can:user_read');
Route::post('/user/create', UserControllerCreate::class)->name('user.create')->middleware('can:user_create');
Route::get('/user/edit/{id}', UserControllerEdit::class)->name('user.edit')->middleware('can:user_update');
Route::put('/user/update/{id}', UserControllerUpdate::class)->name('user.update')->middleware('can:user_update');
Route::put('/user/edit/active/{id}', UserControllerActive::class)->name('user.active')->middleware('can:user_update');
Route::delete('/user/delete/{id}', UserControllerDelete::class)->name('user.delete')->middleware('can:user_delete');

Route::middleware('can:role_admin')->group(function () {
	Route::get('/dashboard', DashboardController::class)->name('dashboard');

	Route::get('/permissions/role', RoleController::class)->name('role.management');
	Route::post('/permissions/role/create', RoleControllerCreate::class)->name('role.create');
	Route::put('/permissions/role/update', RoleControllerUpdate::class)->name('role.update');
	Route::get('/permissions/ability/{id}', RoleAbilityController::class)->name('role.ability');
	Route::post('/permissions/{role_id}/{abilities}', RoleAbilityCreateDelete::class)->name('ability.create.delete');

	Route::post('/role_user/{user_id}/{role_id}', RoleUserCreateDelete::class)->name('role.user.create.delete');
});

Route::get('/person', PersonControllerManagement::class)->name('person.management')->middleware('can:person_read');
Route::get('/person/create', PersonControllerCreate::class)->name('person.create')->middleware('can:person_create');
Route::post('/person/store', PersonControllerStore::class)->name('person.store')->middleware('can:person_create');
Route::get('/person/{id}', PersonControllerView::class)->name('person.view')->middleware('can:person_read');
Route::post('/person-update', PersonControllerUpdate::class)->name('person.update')->middleware('can:person_update');
Route::get('/person-edit/{id}', PersonControllerEdit::class)->name('person.edit')->middleware('can:person_update');
Route::delete('/person/{id}', PersonControllerDelete::class)->name('person.delete')->middleware('can:person_delete');

Route::delete('/person-photo/{id}', PersonPhotoControllerDelete::class)->name('photo.delete')->middleware('can:person_update');

Route::get('/city', CityController::class)->name('city.management')->middleware('can:city_read');
Route::post('/city-create', CityControllerCreate::class)->name('city.create')->middleware('can:city_create');
Route::put('/city-update', CityControllerUpdate::class)->name('city.update')->middleware('can:city_update');

Route::get('/group', GroupController::class)->name('group.management')->middleware('can:group_read');
Route::post('/group-create', GroupControllerCreate::class)->name('group.create')->middleware('can:group_create');
Route::put('/group-update', GroupControllerUpdate::class)->name('group.update')->middleware('can:group_update');

Route::get('/profile', ProfileControllerEdit::class)->name('profile.edit');
Route::patch('/profile', ProfileControllerUpdate::class)->name('profile.update');
Route::delete('/profile', ProfileControllerDestroy::class)->name('profile.destroy');

Route::middleware('auth', 'verified')->group(function () {});

require __DIR__ . '/auth.php';
