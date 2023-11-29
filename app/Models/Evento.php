<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'address',
        'gps',
        'event_date',
        'organizador_id',
        'status',
        'img_event'
    ];
    static $STATUS_ACTIVE = 1; /// Si el evento está activo
    static $STATUS_CANCEL = 2; /// Si el evento está cancelado
    static $STATUS_FINISH = 3; /// Si el evento se finaliza

    public function organizador()
    {
        return $this->belongsTo(Organizador::class)->select('*')->join('users','users.id','id');
    }

    public function vinculacionClientes(){
        return $this->hasMany(VinculacionCliente::class);
    }
}
