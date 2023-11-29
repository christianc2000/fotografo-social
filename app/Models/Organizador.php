<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organizador extends Model
{
    use HasFactory;
    protected $fillable = [
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }
    public function eventosActivos()
    {
        return $this->hasMany(Evento::class)->where('status', Evento::$STATUS_ACTIVE);
    }
    public function eventosCancelados()
    {
        return $this->hasMany(Evento::class)->where('status', Evento::$STATUS_CANCEL);
    }
    public function eventosFinalizados()
    {
        return $this->hasMany(Evento::class)->where('status', Evento::$STATUS_FINISH);
    }
}
