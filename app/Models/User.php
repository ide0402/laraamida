<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $fillable = ['kuji_num'];

    public function player()
    {
        return $this->hasOne(Player::class);
    }

}
