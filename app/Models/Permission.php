<?php

namespace ctf\Models;

use ctf\User;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    protected $softDelete = true;

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
