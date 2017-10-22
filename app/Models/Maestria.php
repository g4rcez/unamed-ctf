<?php

namespace ctf\Models;

use Illuminate\Database\Eloquent\Model;

class Maestria extends Model
{
    protected $fillable = ['nome'];
    protected $softDelete = true;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
}
