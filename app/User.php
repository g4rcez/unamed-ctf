<?php namespace ctf;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Webpatser\Uuid\Uuid;

class User extends Authenticatable
{
    use Notifiable;

    public $incrementing = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'nickname', 'email', 'password', 'capitao',
        'avatar', 'categoria_favorita', 'permissao_id', 'team_id'
    ];
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
            $model->{$model->getKeyName()} = Uuid::generate(4)->string;
        });
    }

    public function challenges()
    {
        return $this->belongsToMany(
            'ctf\Models\Challenge',
            'solveds',
            'users_id',
            'challenges_id'
        );
    }

    public function news()
    {
        return $this->hasMany("ctf\Models\Noticia", 'users_id');
    }

    public function permission()
    {
        return $this->belongsTo('ctf\Models\Permission', 'permission_id');
    }

    public function team()
    {
        return $this->belongsTo('ctf\Models\Team', 'team_id');
    }
}
