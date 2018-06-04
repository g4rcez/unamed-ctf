<?php

namespace ctf\Models;

use Illuminate\Database\Eloquent\Model;

class SkillsRequired extends Model
{
    public $timestamps = false;
    protected $softDelete = true;
    protected $table = 'required_skills';
    protected $fillable = ['skills_id', 'challenges_id'];
}
