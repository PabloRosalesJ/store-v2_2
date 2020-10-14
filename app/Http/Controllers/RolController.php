<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function __invoke()
    {
        return response()->json(['rols' => Rol::all()]);
    }
}
