<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
    use HasFactory;

    protected $fillable = [
        'paciente',
        'email',
        'numero_cel',
        'cep',
        'genero',
        'data_atendimento',
        'queixa',
        'atestado',
        'encaminhamentos',
        'diagnostico',
    ];


    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }
}
