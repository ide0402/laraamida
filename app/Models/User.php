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

    public static function boot(): void
    {
        parent::boot();

        static::deleting(function($user){
            $user->player()->delete();
        });
    }

}
