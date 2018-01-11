<?php

namespace ctf\Models;

use Illuminate\Database\Eloquent\Model;

class MaestriaRequired extends Model
{
    protected $table = 'maestria_required';
    protected $fillable = ['id', 'maestrias_id', 'challenges_id', 'challenges_categories_id'];
    protected $softDelete = true;
    public $timestamps = false;
}
