<?php

namespace ctf\Models;

use Illuminate\Database\Eloquent\Model;

class ChallengesResolvido extends Model
{
    protected $fillable = ['id', 'users_id', 'challenges_id'];
    protected $softDelete = true;
    public $timestamps = true;
}
