<?php

namespace ctf\Models;

use ctf\User;
use Illuminate\Database\Eloquent\Model;

/**
 * @property bool available
 */
class Challenge extends Model
{
    protected $fillable = [
        'name', 'points', 'description', 'author', 'flag',
        'available', 'modified_by', 'categories_id'
    ];
    protected $softDelete = true;
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo("ctf\Models\Category", "categories_id");
    }

    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'solveds',
            'challenges_id',
            'users_id'
        );
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function skills()
    {
        return $this->belongsToMany(
            Skill::class,
            'required_skills',
            'challenges_id',
            'skills_id'
        );
    }
}
