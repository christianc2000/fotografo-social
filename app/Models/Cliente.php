<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;
    protected $fillable=['id','shipping_address'];

    public function user(){
        return $this->belongsTo(User::class, 'id', 'id');
    }
    public function vinculacionclientes(){
        return $this->hasMany(VinculacionCliente::class);
    }
}
