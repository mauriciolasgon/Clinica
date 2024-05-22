<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AgendaController extends Controller
{

    public function index(Request $request)
    {
        $agendas = Agenda::with(['schedules', 'schedules.paciente'])
            ->where('psicologa_id', $request->user()->id)
            ->get();

        return Inertia::render('Agenda/Index', [
            'agendas' => $agendas,
            'psicologa_id' => $request->user()->id
        ]);
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
        return Inertia::render('Agenda/Create', [
            'psicologa_id' => $request->user()->id,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'data' => 'required|date',
            'hora' => 'required|date_format:H:i',
            'tempo_de_sessao' => 'required|integer',
        ]);

        Schedule::create([
            'psicologa_id' => $request->user()->id,
            'data' => $request->input('data'),
            'hora' => $request->input('hora'),
            'tempo_de_sessao' => $request->input('tempo_de_sessao'),
            'ocupado' => false,
            'paciente_id' => null,
        ]);

        return redirect()->route('agendas.index');
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
