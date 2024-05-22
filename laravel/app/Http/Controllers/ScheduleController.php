<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ScheduleController extends Controller
{
    public function index(Request $request)
    {
        $schedules = Schedule::with('paciente')
            ->where('psicologa_id', $request->user()->id)
            ->get();

        return Inertia::render('Schedule/Index', [
            'schedules' => $schedules,
            'psicologa_id' => $request->user()->id
        ]);
    }

    public function getSchedule(Request $request)
    {
        $psicologa_id = $request->query('psicologa_id');
        $schedules = Schedule::with('paciente')
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
            'psicologa_id' => 'required|integer|exists:users,id',
            'data' => 'required|date',
            'paciente_id' => 'required|integer|exists:users,id',
            'tempo_de_sessao' => 'required|integer',
            'observacoes' => 'nullable|string',
            'ocupado' => 'required|boolean'
        ]);

        Schedule::create($request->all());

        return redirect()->route('schedule.index');
    }

    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return Inertia::render('Schedule/Edit', [
            'schedule' => $schedule
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'data' => 'required|date',
            'paciente_id' => 'required|integer|exists:users,id',
            'tempo_de_sessao' => 'required|integer',
            'observacoes' => 'nullable|string',
            'ocupado' => 'required|boolean'
        ]);

        $schedule = Schedule::findOrFail($id);
        $schedule->update($request->all());

        return redirect()->route('schedule.index');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('schedule.index');
    }
}
