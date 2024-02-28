<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
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
        $person = Person::create($request->validated());
        // Validator::make([ 'photo' => $request->photo ], [ 'photo' => 'image|max:5120' ]);
        if ($request->photos) {
            foreach ($request->photos as $photo) {
                // $path = $photo->store('persons'); * Retorna o local onde foi armazenado
                $person->photos()->create(['photo' => $photo->store('persons')]);
            }
        }
    }
}
