<?php

namespace ctf\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $table = 'challenges';
    protected $fillable = [
        'nome', 'pontos', 'enunciado', 'autor', 'flag'
    ];
    protected $softDelete = true;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function categories()
    {
        return $this->belongsToMany(
            Category::class, 'challenges_resolvidos',
            'users_id', 'challenges_id'
        );
    }
}
