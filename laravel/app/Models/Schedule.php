<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'psicologa',
        'data',
        'paciente',
        'horario',
        'tempo_de_sessao',
        'observacoes',
        'ocupado',
    ];

    public function paciente()
    {
        return $this->belongsTo(User::class, 'paciente_id');
    }

    public function psicologa()
    {
        return $this->belongsTo(User::class, 'psicologa_id');
    }

    public function agenda()
    {
        return $this->belongsTo(Agenda::class);
    }
}
