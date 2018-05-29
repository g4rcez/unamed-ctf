<?php

namespace ctf\Models;

use Illuminate\Database\Eloquent\Model;

class MaestriaRequired extends Model
{
    public $timestamps = false;
    protected $table = 'maestria_required';
    protected $fillable = ['maestrias_id', 'challenges_id'];
    protected $softDelete = true;
}
