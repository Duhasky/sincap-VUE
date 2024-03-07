<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Http\Requests\PersonUpdateRequest;
use App\Models\Person;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class PersonControllerUpdate extends Controller
{
	/**
	 * Handle the incoming request.
	 */
	public function __invoke(PersonUpdateRequest $request)
	{
		// dd($request);
		$person = Person::findOrFail($request->id);
		$person->update($request->validated());

		if ($request->new_photos) {
			$manager = new ImageManager(new Driver());

			foreach ($request->new_photos as $photo) {
				// read image from file system
				$image = $manager->read($photo);

				// resize image proportionally to 1240px height
				$image->scale(height: 1240);

				$customName = str_replace(' ', '_', $person->surname) . '_' . uniqid() . '.' . $photo->getClientOriginalExtension();
				$customName = 'storage/persons/' . $customName;

				$image->save(public_path($customName));

				$person->photos()->create(['photo' => $customName]);
			}
		}
	}
}
