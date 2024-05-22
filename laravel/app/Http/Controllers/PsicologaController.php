<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class PsicologaController extends Controller
{
    public function index()
    {
        
        $psicologas = User::where('role', 2)->get();
        return response()->json($psicologas);
    }
}
