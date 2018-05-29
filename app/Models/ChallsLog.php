<?php

namespace ctf\Models;

use Illuminate\Database\Eloquent\Model;

class ChallsLog extends Model
{
    protected $guarded = ['id'];
    protected $fillable = [
        'users_id', 'status', 'challenges_id'
    ];
    protected $softDelete = true;
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
}
