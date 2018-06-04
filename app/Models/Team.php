<?php

namespace ctf\Models;

use ctf\User;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $table = 'team';
    protected $fillable = ['name', 'tag', 'token', 'avatar'];
    protected $guarded = ['id'];
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    public function users()
    {
        return $this->hasMany(User::class, 'team_id');
    }
}
