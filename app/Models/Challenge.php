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

    public function category(){
        return $this->belongsTo("ctf\Models\Category", "categories_id");
    }
}
