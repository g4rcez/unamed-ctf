<?php

namespace ctf\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['nome', 'color', 'descricao'];
    protected $softDelete = true;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
}
