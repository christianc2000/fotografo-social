<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $fillable = [
        'url',
        'url_low_quality',
        'tipo',
        'clientes',
        'imageable_id',
        'imageable_type',
        'quantity',
        'categoria_id',
        'fotografo_id',
    ];
   
    public function imageable()
    {
        return $this->morphTo();
    }
   
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    public function fotografo()
    {
        return $this->belongsTo(Fotografo::class);
    }
}
