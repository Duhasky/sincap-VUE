<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Ramsey\Uuid\Type\Integer;

class UserControllerDelete extends Controller
{
  /**
   * Handle the incoming request.
   */
  public function __invoke($id)
  {
    User::find($id)->delete();
  }
}
