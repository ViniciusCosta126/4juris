<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = ['usuario_id', 'cliente_nome'];

    public function user()
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
