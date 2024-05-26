<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Ficha;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FichaController extends Controller
{
    public function index()
    {   
        
        return Inertia::render('Ficha/Pacientes');

    }

    public function ficha(Request $request)
    {   
        $agendamento = $request->query('data');
        
        return Inertia::render('Ficha/Ficha' ,[
            'agendamento' => $agendamento
        ]);

    }

    public function attFicha(Request $request)
    {
     
        // Obtenha os dados do formulário
        $dadosFicha = $request->query('dadosFormulario');
        echo $dadosFicha;

        // Encontre a ficha correspondente no banco de dados
        $ficha = Ficha::find($dadosFicha['id']);
        
        // Atualize os dados da ficha com os novos dados do formulário
        $ficha->update($dadosFicha);

        // Retorne uma resposta de sucesso
        return response()->json(['message' => 'Ficha atualizada com sucesso']);
    }
}





