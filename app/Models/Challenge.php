<?php

namespace ctf\Models;

use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    protected $fillable = [
        'nome', 'pontos', 'enunciado', 'autor', 'flag'
    ];
    protected $softDelete = true;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function category(){
        return $this->belongsTo("ctf\Models\Category", "categories_id");
    }

    public function users()
    {
        return $this->belongsToMany(
            'ctf\User',
            'challenges_resolvidos',
            'challenges_id',
            'users_id'
        );
    }
    public function skills()
    {
        return $this->belongsToMany(
            'ctf\Models\Maestria',
            'maestria_required',
            'challenges_id',
            'maestrias_id'
        );
    }
}
