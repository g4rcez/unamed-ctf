<?php

namespace ctf\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $fillable = [
        'nome', 'pontos', 'enunciado', 'autor', 'flag'
    ];
}
