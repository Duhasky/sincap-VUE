<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonStoreRequest;
use App\Models\Person;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PersonControllerStore extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(PersonStoreRequest $request)
    {
        $person = Person::create($request->validated());
        // create image manager with desired driver
        $manager = new ImageManager(new Driver());

        foreach ($request->photos as $photo) {
            // read image from file system
            $image = $manager->read($photo);

            // resize image proportionally to 300px width
            $image->scale(height: 1240);

            $customName = str_replace(' ', '_', $person->surname)  . '_' . uniqid(). '.'.$photo->getClientOriginalExtension();
            $customName = 'storage/persons/'  . $customName;

            $image->save(public_path($customName));

            $person->photos()->create(['photo' => $customName]);
        }
    }
}
