<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use App\Models\Ficha;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
       
        $psicologas=User::where('role',2)->get();

        return Inertia::render('Schedule/Index', [
            'psicologas' => $psicologas
        ]);
    }

    public function getSchedule(Request $request)
    {
        $psicologa_id = $request->query('psicologa_id');
        $schedules = Schedule::with('paciente','ficha')
            ->where('psicologa_id', $psicologa_id)
            ->get();
        return response()->json($schedules);
    }
    

    public function create(Request $request)
    {
        return Inertia::render('Schedule/Create', [
            'psicologa_id' => $request->user()->id
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            
            'psicologa_id' => 'required|exists:users,id',
            'data' => 'required|date',
            'horario' => 'required|date_format:H:i',
            'tempo_sessao' => 'required|date_format:H:i:s',
            'observacoes' => 'nullable|string',
            'ocupado' => 'required|boolean',
        ]);

        Schedule::create($request->all());

        return redirect()->route('agendas.index')->with('success', 'Schedule criado com sucesso!');
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return Inertia::render('Schedule/Edit', [
            'schedule' => $schedule
        ]);
    }

    public function update(Request $request,$schedule_id)
    {
        try {
            $request->validate([
                'paciente_id' => 'required|integer|exists:users,id',
                'ocupado' => 'required|boolean'
            ]);
    
            $schedule = Schedule::findOrFail($schedule_id);
            $ficha=Ficha::create([
                'paciente_id' => $request->user()->id,
                'paciente_name'=>$request->user()->name,
                'email'=>$request->user()->email,
                'cep'=>$request->user()->cep, 
                'numero_cel'=>$request->user()->numero_cel,
                'genero'=>null,
                'data_atendimento'=>$schedule->data,
                'queixa'=>null,
                'atestado'=>null,
                'encaminhamentos'=>null,
                'diagnostico'=>null
            ]);
            $schedule->update([
                'paciente_id' => $request->user()->id,
                'ocupado' =>true,
                'ficha_id'=>$ficha->id,
            ]);

            
    
            return redirect()->route('schedule.paciente');

        } catch (\Exception $e) {
            // Se ocorrer algum erro durante o processo, retorne uma resposta de erro com detalhes
            return response()->json(['error' => $e->getMessage()], 500);
        }
        
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('schedule.index');
    }

    public function pacient_schedule(Request $request)
    {
        $agendamentos = Schedule::with('paciente','ficha')
            ->where('paciente_id', $request->user()->id)
            ->get();

        return Inertia::render('Schedule/Paciente', [
            'agendamentos' => $agendamentos
        ]);
    }
}
