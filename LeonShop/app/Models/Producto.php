<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    protected $fillable = ['precio', 'unidades', 'modelo', 'nombre', 'tipo', 'marca_id'];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function comentarios()
    {
        return $this->hasMany(Comentario::class);
    }

    public function compras()
    {
        return $this->hasMany(Compra::class);
    }

}

