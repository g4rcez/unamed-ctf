<?php

namespace ctf\Models;

use Illuminate\Database\Eloquent\Model;

class Maestria extends Model
{
    protected $table = 'maestrias';
    protected $fillable = ['maestria'];
    protected $softDelete = true;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
}
