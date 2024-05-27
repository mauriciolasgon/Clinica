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
        try {
            // Obtenha os dados do formulário a partir do corpo da requisição
            $dadosFicha = $request->all();

            if (!$dadosFicha) {
                return response()->json(['error' => 'Dados do formulário não fornecidos'], 400);
            }

            // Validar os dados
            $validatedData = $request->validate([
                'id' => 'required|integer|exists:fichas,id',
                'paciente_id' => 'required|integer|exists:users,id',
                'paciente_name' => 'required|string',
                'email' => 'required|email',
                'numero_cel' => 'required|string',
                'genero' => 'required|string',
                'cep' => 'required|string',
                'data_atendimento' => 'required|date',
                'queixa' => 'nullable|string',
                'atestados' => 'nullable|string',
                'diagnostico' => 'nullable|string',
                'encaminhamentos' => 'nullable|string'
            ]);

            // Encontre a ficha correspondente no banco de dados
            $ficha = Ficha::find($dadosFicha['id']);
            
            // Verifique se a ficha foi encontrada
            if (!$ficha) {
                return response()->json(['error' => 'Ficha não encontrada'], 404);
            }

            // Atualize os dados da ficha com os novos dados do formulário
            $ficha->update($dadosFicha);

            // Retorne uma resposta de sucesso
            return response()->json(['message' => 'Ficha atualizada com sucesso']);
        } catch (\Exception $e) {
            // Se ocorrer algum erro durante o processo, retorne uma resposta de erro com detalhes
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}




