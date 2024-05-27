<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;

class AgendaController extends Controller
{

    public function index(Request $request)
    {
        $agendas = Schedule::with(['psicologa', 'paciente'])
            ->where('psicologa_id', $request->user()->id)
            ->get();

        return Inertia::render('Agenda/Index', [
            'agendas' => $agendas,
            'psicologa_id' => $request->user()->id
        ]);
    }

    public function getPsicologa()
    {
        $agendas = Agenda::with('psicologa')->get();
        return response()->json($agendas);
    }

    public function teste(Request $request)
    {
        $psicologa_id = $request->query('psicologa_id');
        $agendas = Agenda::with(['schedules', 'schedules.paciente'])
            ->where('psicologa_id', $psicologa_id)
            ->get();
        return response()->json($agendas);
    }

    public function create(Request $request)
    {
        $schedules = Schedule::where('psicologa_id', $request->user()->id)->get();
        return Inertia::render('Agenda/Create', [
            'psicologa_id' => $request->user()->id,
            'schedules' => $schedules
        ]);
    }

    public function store(Request $request)
{

    Log::info('Recebendo dados da requisição', $request->all());

    $request->validate([
        'data' => 'required|date',
        'horario' => 'required|date_format:H:i',
        'tempo_sessao' => 'required|date_format:H:i:s',
    ]);

    Schedule::create([
        'psicologa_id' => $request->user()->id,
        'data' => $request->input('data'),
        'horario' => $request->input('horario'), 
        'tempo_sessao' => $request->input('tempo_sessao'),
        'ocupado' => false,
        'paciente_id' => null,
        'ficha_id'=>0,
    ]);

    return redirect()->route('agendas.index')->with('success', 'Agenda e Schedule criados com sucesso!');
}

    public function edit($id)
    {
        $agenda = Agenda::with('schedule')->findOrFail($id);
        $schedules = Schedule::where('psicologa_id', $agenda->psicologa_id)->get();

        return Inertia::render('Agenda/Edit', [
            'agenda' => $agenda,
            'schedules' => $schedules
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'schedule_id' => 'required|integer|exists:schedules,id',
        ]);

        $agenda = Agenda::findOrFail($id);
        $agenda->update($request->all());

        return redirect()->route('agendas.index');
    }

    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);
        $agenda->delete();

        return redirect()->route('agendas.index');
    }
}
