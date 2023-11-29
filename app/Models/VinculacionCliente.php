<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VinculacionCliente extends Model
{
    use HasFactory;
    protected $fillable = [
        'assistance',
        'qr_assistance',
        'assistance_date',
        'accept_date',
        'evento_id',
        'cliente_id'
    ];

    public function evento(){
        return $this->belongsTo(Evento::class);
    }
    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
