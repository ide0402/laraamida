<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;
    protected $fillable = ['player_field', 'publish_flg'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
