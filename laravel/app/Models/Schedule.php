<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'agenda_id',
        'psicologa_id',
        'data',
        'paciente_id',
        'horario',
        'tempo_sessao',
        'observacoes',
        'ocupado',
        'ficha_id',
    ];

    public function paciente()
    {
        return $this->belongsTo(User::class, 'paciente_id');
    }

    public function psicologa()
    {
        return $this->belongsTo(User::class, 'psicologa_id');
    }

    public function ficha()
    {
        return $this->belongsTo(Ficha::class,'ficha_id');
    }
}
