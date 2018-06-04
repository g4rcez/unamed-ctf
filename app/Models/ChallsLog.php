<?php

namespace ctf\Models;

use Illuminate\Database\Eloquent\Model;

class ChallsLog extends Model
{
    protected $guarded = ['id'];
    protected $softDelete = true;
    protected $fillable = ['users_id', 'status', 'challenges_id'];
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
}
