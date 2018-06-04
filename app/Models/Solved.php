<?php

namespace ctf\Models;

use Illuminate\Database\Eloquent\Model;

class Solved extends Model
{
    protected $softDelete = true;
    protected $fillable = ['id', 'users_id', 'challenges_id'];
}
