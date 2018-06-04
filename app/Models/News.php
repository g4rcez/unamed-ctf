<?php

namespace ctf\Models;

use ctf\User;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $guarded = ['id'];
    protected $softDelete = true;
    protected $dates = ['deleted_at'];
    protected $fillable = ['users_id', 'descricao', 'titulo'];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsTo(User::class, "users_id");
    }
}
