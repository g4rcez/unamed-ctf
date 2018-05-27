<?php

namespace ctf\Models;

use Illuminate\Database\Eloquent\Model;

class ChallsLog extends Model
{
    protected $fillable = ['status', 'users_id', 'challenges_id'];
    protected $softDelete = true;
    public $timestamps = true;
}
