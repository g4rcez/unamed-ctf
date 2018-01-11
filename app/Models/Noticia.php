<?php

namespace ctf\Models;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = 'noticias';
    protected $fillable = ['users_id', 'descricao', 'titulo'];
    protected $softDelete = true;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];


    public function users()
    {
        return $this->belongsTo("ctf\User", "users_id");
    }
}
