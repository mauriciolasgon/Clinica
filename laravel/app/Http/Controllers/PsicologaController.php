<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PsicologaController extends Controller
{
    public function index()
    {   
        try {
            $psicologas = User::where('role', 2)->get();
            Log::info('Psicologas encontradas:', ['psicologas' => $psicologas]);

            return response()->json($psicologas);
        } catch (\Exception $e) {
            Log::error('Erro ao buscar psicólogas:', ['message' => $e->getMessage()]);
            return response()->json(['error' => 'Erro ao buscar psicólogas'], 500);
        }
    }
}

