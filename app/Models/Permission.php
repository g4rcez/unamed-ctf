<?php

namespace ctf\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $timestamps = false;
    protected $table = 'permissao';
    protected $fillable = ['permissao'];
    protected $softDelete = true;

    public function users()
    {
        return $this->hasMany('ctf\User');
    }
}
