<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonPhotoStoreUpdateRequest;
use App\Http\Requests\PersonStoreUpdateRequest;
use App\Models\Person;
use Illuminate\Support\Facades\Validator;

class PersonControllerStore extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(PersonStoreUpdateRequest $request)
    {
        if ($request->validated()) {
        $person = Person::create($request->validated());
            foreach ($request->photos as $photo) {
                $customName = str_replace(' ', '_', $person->surname)  . '_' . uniqid(). '.'.$photo->getClientOriginalExtension();
                $person->photos()->create(['photo' => $photo->storeAs('persons', $customName)]);
            }
        }
    }
}
