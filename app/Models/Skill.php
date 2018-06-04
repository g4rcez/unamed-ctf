<?php

namespace ctf\Models;

use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    protected $fillable = ['name'];
    protected $softDelete = true;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function challenges()
    {
        return $this->belongsToMany(
            Challenge::class,
            'required_skills',
            'skills_id',
            'challenges_id'
        );
    }
}
