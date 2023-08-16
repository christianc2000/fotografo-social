<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fotografo extends Model
{
    use HasFactory;
    protected $fillable=['id','descripcion'];

    public function user(){
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
