<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'kuji_num', 'pass', 'manager_comment'];

    public function items()
    {
        return $this->hasMany('App\Models\Item','users_id');
    }

}
