<?php

namespace ctf\Models;

use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Category extends Model
{
    public $incrementing = false;
    protected $softDelete = true;
    protected $table = 'categories';
    protected $dates = ['deleted_at', 'created_at', 'updated_at'];
    protected $fillable = ['id', 'nome', 'color', 'descricao', 'modificado_por'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->{$model->getKeyName()} = Uuid::generate(4)->string;
        });
    }

    public function challenge()
    {
        return $this->hasMany("ctf\Models\Challenge", 'categories_id');
    }

}
