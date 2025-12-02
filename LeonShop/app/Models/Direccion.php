<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $fillable = [
        'user_id',
        'direccion_envio',
        'direccion_facturacion'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

