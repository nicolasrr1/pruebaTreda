<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;


 protected $table = 'producto';
 
 protected $fillable = [
    'nombre',
    'sku',
    'valor',
    'imagen',
    'tienda'
 ];


 public function Tienda () {
   return $this->belongsTo('App\Models\Tienda', 'tienda');
 }


}
