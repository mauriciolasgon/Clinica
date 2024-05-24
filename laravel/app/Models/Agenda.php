<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $fillable = [
        'psicologa_id',
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function psicologa()
    {
        return $this->belongsTo(User::class, 'psicologa_id');
    }
}
