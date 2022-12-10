<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tienda extends Model
{
    use HasFactory;

    protected $table = 'tienda';
    
    protected $fillable =[
       'nombre', 
       'fecha_apertura'
    ];

    //realacion de uno a mucho
    public function Tienda(){
        return $this->hasMany('App\Models\Producto');
    }
}
