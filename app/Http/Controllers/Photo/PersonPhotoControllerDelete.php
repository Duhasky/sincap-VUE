<?php

namespace App\Http\Controllers\Photo;

use App\Http\Controllers\Controller;
use App\Models\PersonPhoto;
use Illuminate\Support\Facades\Storage;

class PersonPhotoControllerDelete extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $photo = PersonPhoto::find($id);
        Storage::disk('public')->delete(str_replace('storage/', '', $photo->photo));
        $photo->delete();
    }
}
