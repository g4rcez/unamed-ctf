<?php namespace ctf;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nickname', 'email', 'password',
        'avatar', 'categoria_favorita',
    ];

    public $incrementing = false;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = md5(rand());
            return true;
        });
    }

    public function challenges()
    {
        return $this->belongsToMany(
            'ctf\Models\Challenge',
            'challenges_resolvidos',
            'users_id',
            'challenges_id'
        );
    }

    public function news()
    {
        return $this->hasMany("ctf\Models\Noticia", 'users_id');
    }
}
