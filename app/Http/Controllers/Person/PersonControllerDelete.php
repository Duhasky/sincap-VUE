<?php

namespace App\Http\Controllers\Person;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PersonControllerDelete extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->photos) {
            foreach ($request->photos as $p) {
                $relativePath = str_replace('storage/', '', $p['photo']);
                try {
                    Storage::disk('public')->delete($relativePath);
                } catch (\Exception $e) {
                    Log::error('Erro ao deletar o arquivo ' . $relativePath . ': ' . $e->getMessage());
                }
            }
        }
        Person::destroy($request->id);
    }
}
