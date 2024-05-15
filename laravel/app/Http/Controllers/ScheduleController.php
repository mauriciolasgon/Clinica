<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use Inertia\Inertia;

class ScheduleController extends Controller
{
    public function index()
    {
        $schedules = Schedule::all();
        return Inertia::render('Schedule/Index', ['schedules' => $schedules]);
    }

    public function create()
    {
        return Inertia::render('Schedule/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        Schedule::create([
            'title' => $request->title,
            'date' => $request->date,
        ]);

        return redirect()->route('api.schedules.index')->with('success', 'Agendamento criado com sucesso!');
    }

    public function edit(Schedule $schedule)
    {
        return Inertia::render('Schedule/Edit', ['schedule' => $schedule]);
    }

    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
        ]);

        $schedule->update([
            'title' => $request->title,
            'date' => $request->date,
        ]);

        return redirect()->route('api.schedules.index')->with('success', 'Agendamento atualizado com sucesso!');
    }

    public function destroy(Schedule $schedule)
    {
        $schedule->delete();

        return redirect()->route('api.schedules.index')->with('success', 'Agendamento excluído com sucesso!');
    }
}
