<?php

namespace ctf\Models;

use Illuminate\Database\Eloquent\Model;

class Maestria extends Model
{
    protected $table = 'maestrias';
    protected $fillable = ['maestria'];
    protected $softDelete = true;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function challenges()
    {
        return $this->belongsToMany(
            'ctf\Models\Challenge',
            'maestria_required',
            'maestrias_id',
            'challenges_id'
        );
    }
}
